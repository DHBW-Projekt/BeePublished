<?php

App::uses('AppModel', 'Model');

class ContactFormAppModel extends AppModel {
	public $name = 'ContactForm';
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

