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
            'required' => array(
                'rule' => array('email','isUnique'),
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
