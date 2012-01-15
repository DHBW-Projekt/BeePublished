<?php
App::uses('AppModel', 'Model');

/**
 * ContactRequest Model.
 */
class ContactRequest extends AppModel {

	/*Name*/
	public $name = 'ContactRequest';
	
	/*No DB*/
	public $useTable = false;
	
	/*Validation rules*/
	public $validate = array(
				'email' => array(
		            'rule' => array('notEmpty','email'),
					'message' => 'Please enter a valid e-mail address.'
	),
				'subject' => array(
		            'rule' => 'notEmpty',
					'message' => 'Please enter a subject.'
	),
		        'body' => array(
		            'rule' => 'notEmpty',
					'message' => 'Please enter your message.'
	)
	);

}