<?php
App::uses('AppModel', 'Model');

class ApplicationForMembershipModel extends AppModel{
	
	public $name = 'ApplicationForMembership';
	
	/*public $formOfMembership = true;
	public $title = '';
	public $name = '';
	public $firstname = '';
	public $dateOfBirth = '';
	public $email = '';
	public $telephone = '';
	public $street = '';
	public $zip = '';
	public $city = '';
	public $comment = '';*/
	
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
		     	   'rule' => 'notEmpty',
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