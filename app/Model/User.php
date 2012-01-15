<?php
App::uses('AppModel', 'Model', 'AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Role $Role
 * @property LogEntry $LogEntry
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
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'An email is required.'
            ),
            'notUnique' => array(
    			'rule' => 'isUnique',
    			'message' => 'This email has already been taken. If you forgor your password, please reset it.'
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
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'LogEntry' => array(
            'className' => 'LogEntry',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
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
}
