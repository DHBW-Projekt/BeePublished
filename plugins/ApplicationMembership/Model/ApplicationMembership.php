<?php
App::uses('AppModel', 'Model');
/**
 * Model ApplicationMembership.
 */
class ApplicationMembership extends AppModel{
	
	/**
	 * Validation
	 */
	public $validate = array(
			'type' => array(
					'rule' => 'notEmpty',
					 'message' => 'Please enter the application type.'
			),
			'title' => array(
					'rule' => 'notEmpty',
					 'message' => 'Please enter your title.'
			),
			'last_name' => array(
			        'rule' => 'notEmpty',
			        'message' => 'Please enter your lastname.'
			),
			'first_name' => array(
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