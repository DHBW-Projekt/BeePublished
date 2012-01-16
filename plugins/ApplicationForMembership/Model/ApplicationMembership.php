<?php
App::uses('AppModel', 'Model');

class ApplicationMembership extends AppModel{
	
	/**
	 * Validation
	 */
	public $validate = array(
			'name' => array(
			        'rule' => 'notEmpty',
			        'message' => 'Please enter your name.'
			),
			'firstname' => array(
			        'rule' => 'notEmpty',
			        'message' => 'Please enter your firstname.'
			),
		    'email' => array(
		     	   'rule' => 'email',
		           'message' => 'Please enter your email.'
			),
			'street' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your street and street number.'
			),
			'zip' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your zip.'
			),
			'city' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your city.'
			)
	);
}