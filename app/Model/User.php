<?php
App::uses('AppModel', 'Model', 'AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Role $Role
 * @property Page $Page
 */
class User extends AppModel
{
    public $name = 'User';

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required.'
            ),
		    'notUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This username has already been taken. Please choose another username.'
		    ),
		    'alphanumeric' => array(
    			'rule' => 'alphaNumeric',
    			'message' => 'Usernames must only contain letters and numbers.'
		    )
        ),
        'password' => array(
            'required' => array(
                'message' => 'A password is required',
                'rule' => array('notEmpty')
            ),
            'minLength' => array(
            	'message' => 'Password is too short. Please choose a password with at least 8 characters.',
    			'rule' => array('minLength', '8')
            )
        ),
    	'current_password' => array(
    		'required' => array(
    			'message' => 'Please enter your current password.',
    			'rule' => array('notEmpty')
	    	),
	    	'current_password' => array(
	    		'rule' => 'verifyCurrentPassword',
	    		'message' => 'Current password was not entered correctly'
	    	)
    	),
        'password_confirm' => array(
		    'match' => array(
    			'rule' => array('confirmPassword', 'password', 'password_confirm'),
    			'message' => 'Passwords do not match'
		    )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Please supply a valid & active email address.'
            ),
            'notUnique' => array(
    			'rule' => 'isUnique',
    			'message' => 'This email has already been taken. If you forgot your password, please reset it.'
            )
        )
    );

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'username';

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * beforeSave function
     *
     * @return boolean
     */
    public function beforeSave()
    {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }


    /**
     * parentNode function
     *
     * @return array
     */
    function parentNode()
    {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['role_id'])) {
            $roleId = $this->data['User']['role_id'];
        } else {
            $roleId = $this->field('role_id');
        }
        if (!$roleId) {
            return null;
        } else {
            return array('Role' => array('id' => $roleId));
        }
    }

    /**
     * bindNode function
     *
     * @return array
     */
    function bindNode($user)
    {
        return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
    }
    
    public function confirmPassword($check, $password1, $password2) {
    	if (Security::hash($this->data['User'][$password1], null, true) == Security::hash($this->data['User'][$password2], null, true)) {
    		return true;
    	}
    }
    
    public function verifyCurrentPassword($data){
    	$id = $this->data[$this->alias]['id'];
    	$pwd = $this->field('password', array('id' => $id));
    	if(AuthComponent::password($data['current_password']) != $pwd) {
    		return false;
    	}
    	return true;
    }
}
