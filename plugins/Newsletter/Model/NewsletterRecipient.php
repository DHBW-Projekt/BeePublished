<?php
App::uses('AppModel', 'Model');
/**
 * NewsletterRecipient Model
 *
 * @property User $User
 */
class NewsletterRecipient extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
        'email' => array(
	        'email_isunique' => array(
            	'rule'    => 'isUnique',
            	'message' => 'This e-mail address is already registered.',
         	),
		'name_notEmpty' => array(
	                        'rule'    => 'notEmpty', 
	                         'required' => true,
	                      'message' => 'This field name has to be filled.'
			),
        	'email_address_verification' => array(
            	'rule'    => array('email'),
            	'message' => 'The e-mail address was not entered correctly.'
        	)
        )
    );
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
