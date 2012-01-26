<?php
App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */

class UsersController extends AppController
{
    public $uses = array('User', 'Role', 'MenuEntry');
    var $components = array('BeeEmail', 'Password', 'Menu');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->PermissionValidation->actionAllowed(null, 'UserManagement', true);

        $this->layout = 'overlay';
        $roles = $this->Role->find('all');
        $this->set('roles', $roles);
        $this->set('systemPage', false);
        $this->set('adminMode', true);
    }

    /**
     * add method
     *
     * @return void
     */
    public function register()
	{
		if ($this->request->is('post')) {
			$user = $this->request->data['User'];
			$this->User->create();
			//modify value of 'registered' attribute to current date!
			$now = date('Y-m-d H:i:s');
			$user['registered'] = $now;
			//generate confirmation token
			$token = sha1($user['username'] . rand(0, 100));
			//modify value of 'confirmation_token' attribute to generated token!
			$user['confirmation_token'] = $token;
			//set status to "new"
			$user['status'] = false;
			//set role to "registered"
			$role = $this->Role->findByName('Registered');
			$roleId = $role['Role']['id'];
			$user['role_id'] = $roleId;
				
			$this->request->data['User'] = $user;
			//save data to database
			if ($this->User->save($user)) {
				//create email and set header fields and viewVars
				$port = env('SERVER_PORT');
				$activationUrl = 'http://' . env('SERVER_NAME');
				if ($port != 80) {
					$activationUrl = $activationUrl . ':' . $port;
				}
				$activationUrl = $activationUrl . $this->webroot . 'activateUser/' . $this->User->getLastInsertID() . '/' . $user['confirmation_token'];
				$viewVars = array(
					'username' => $user['username'],
					'activationUrl' => $activationUrl,
					'url' => env('SERVER_NAME'),
					'confirmationToken' => $user['confirmation_token']
				);
				$this->BeeEmail->sendHtmlEmail($user['email'], 'Registration complete - Please confirm your account', $viewVars, 'user_confirmation');
				$this->Session->setFlash('The user has been created.');
				$this->redirect(array('action' => 'login'));
			} else{
				$this->Session->setFlash('The user couldn\'t be created!', 'default', array('class' => 'flash_failure'));
			}
        }
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
        $this->set('adminMode', false);
        $this->set('systemPage', true);
    }

    public function activateUser($userId = null, $tokenIn = null)
    {
        $this->User->id = $userId;
        if ($this->User->exists()) {
            $userDB = $this->User->findById($userId);
            $tokenDB = $userDB['User']['confirmation_token'];
            if ($tokenIn == $tokenDB) {
                // Update the status flag to active
                $this->User->saveField('status', true);
                $viewVars = array(
                    'username' => $userDB['User']['username'],
                    'url' => env('SERVER_NAME')
                );
                $this->BeeEmail->sendHtmlEmail($userDB['User']['email'], 'User activated', $viewVars, 'user_activated');
                $this->Session->setFlash('Your user has been activated.');
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash('Token invalid! Your user hasn\'t been activated.', 'default', array('class' => 'flash_failure'));
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        } else {
            //user not exists exception
            throw new NotFoundException(__('Invalid user'));
        }
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->PermissionValidation->actionAllowed(null, 'UserManagement', true);

        $this->layout = 'overlay';
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'flash_failure'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->PermissionValidation->actionAllowed(null, 'UserManagement', true);

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->id == $this->Auth->user('id')) {
            $this->Session->setFlash(__('You cannot delete your own user.'), 'default', array('class' => 'flash_failure'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'default', array('class' => 'flash_failure'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * login function
     *
     * @return void
     */
    function login()
    {
        if ($this->request->is('post')) {
            //if user is already logged in
            if ($this->Auth->loggedIn()) {
                $this->Session->setFlash('You are already logged in!');
            }
            //if user isn't already logged in
            else {
                $userDB = $this->User->findByUsername($this->request->data['User']['username']);
                if ($userDB['User']['status']) {
                    if ($this->Auth->login()) {
                        //update "last_login"
                        $this->User->id = $this->Auth->user('id');
                        $now = date('Y-m-d H:i:s');
                        $this->User->saveField('last_login', $now);
                        $this->Session->setFlash('Welcome');
                        $this->redirect($this->Auth->redirect());
                    } else {
                        $this->Session->setFlash('Your username or password was incorrect.', 'default', array('class' => 'flash_failure'));
                        $this->redirect($this->referer());
                    }
                } else {
                    $this->Session->setFlash('Login not possible! Your user either hasn\'t been activated yet or has been locked!', 'default', array('class' => 'flash_failure'));
                    $this->redirect($this->referer());
                }
            }
        }
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
        $this->set('adminMode', false);
        $this->set('systemPage', true);
    }

    /**
     * logout function
     *
     * @return void
     */
    function logout()
    {
        $this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }

    /**
     * beforeFilter function
     *
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('register', 'activateUser', 'resetPassword', 'login');
    }

    /**
     * resetPassword function
     * Generates a new password and send it per email to the user
     * Passwordlenght is 10 characters
     * @return void
     */
    function resetPassword($username = null, $email = null)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
        	$username = $this->request->data['User']['username'];
            $email = $this->request->data['User']['email'];

            $conditions = array('username' => $username, 'email' => $email);
            $userDB = $this->User->find('first', array('conditions' => $conditions));
			if ($userDB) {
                // Generates a new password (10 characters)
                $newpw = $this->Password->generatePassword(10);
                //Set new password
                $this->User->id = $userDB['User']['id'];
                if ($this->User->saveField('password', $newpw)) {
                    $viewVars = array(
                        'username' => $username,
                        'url' => env('SERVER_NAME'),
                        'newPassword' => $newpw
                    );

                    $this->BeeEmail->sendHtmlEmail($userDB['User']['email'], 'Your new password', $viewVars, 'user_new_password');
                    
                    $this->Session->setFlash('Your password has been resetted. The new password was send to your emailaddress.');
                    $this->redirect(array('action' => 'login'));
                }
			} else {
                $this->Session->setFlash('Username and/or Email were wrong!', 'default', array('class' => 'flash_failure'));
            }
        }
        $this->set('adminMode', false);
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
        $this->set('systemPage', true);
    }
    
    function changePassword($username = null){
    	if ($this->request->is('post') || $this->request->is('put')) {
    		$data = $this->request->data;
    		$data['User']['id'] = $data['id'];
    		$userId = $this->Session->read('Auth.User.id');
    		$this->User->id = $userId;
    		
    		if($this->User->exists()){
    			$userDB = $this->User->findById($this->User->id);
    		}
    		
    		$this->User->set($data);
    		if($this->User->validates()){
    			if($this->User->saveField('password', $data['User']['password'])){
    				$this->Session->setFlash("Your password has been changed!", 'default', array('class' => 'flash_success'));
    				$this->redirect($this->referer());
    			}
    		}
    		$this->Session->setFlash("Your password hasn't been changed!", 'default', array('class' => 'flash_failure'));
    	}
    	$this->set('adminMode', false);
    	$this->set('menu', $this->Menu->buildMenu($this, NULL));
    	$this->set('systemPage', true);
    }

    /**
     * changeRole method
     *
     * @param string $id
     * @return void
     */
    function changeRole($id = null, $newRole = null)
    {
        $this->PermissionValidation->actionAllowed(null, 'UserManagement', true);

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post')) {
            $this->User->set('role_id', $newRole);
            $this->User->save();
        }
    }

}
