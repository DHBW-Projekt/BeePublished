<?php
App::uses('AppModel', 'Model');

/**
 * ContactRequest Model.
 */
class ContactRequest extends AppModel {
	
	/*No DB*/
	public $useTable = false;
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("contact_form", $value, true));
	}
		
	/*Validation rules*/
	public $validate = array(
				'email' => array(
		            'rule' => 'email',
		            'required' => true,
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