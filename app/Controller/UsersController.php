<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController
{
    public $uses = array('User', 'Role', 'MenuEntry');
    var $components = array('Email', 'Menu');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
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
            $token = sha1($this->data['User']['username'] . rand(0, 100));
            //modify value of 'confirmation_token' attribute to generated token!
            $user['confirmation_token'] = $token;
            //set status to "new"
            $user['status'] = 0;
            //set role to "registered"
            $role = $this->Role->findByName('registered');
            $roleId = $role['Role']['id'];
            $user['role_id'] = $roleId;

            $this->request->data['User'] = $user;
            //save data to database
            if ($this->User->save($user)) {
                //build email header for verification
                //$this->Email->from = 'ouremail@dualoncms.com';
                //$this->Email->to = $this->request->data['User']['email'];
                //$this->Email->subject = 'Confirmation of your registration at dualoncms.com';
                //build email body for verification

                //send email for verification

                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
        $this->set('adminMode', false);
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
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
            if ($this->Session->read('Auth.User')) {
                $this->Session->setFlash('You are already logged in!');
            }
            //if user isn't already logged in
            else {
                if ($this->Auth->login()) {
                    //update "last_login"
                    $this->User->id = $this->Auth->user('id');
                    $now = date('Y-m-d H:i:s');
                    $this->User->saveField('last_login', $now);

                    $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash('Your username or password was incorrect.');
                }
            }
        }
        $this->set('adminMode', false);
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
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
        $this->Auth->allow('register', 'logout');
        $this->Auth->autoRedirect = false;
    }
}
