<?php
App::uses('AppModel', 'Model');
/**
 * GuestbookPost Model
 *
 */
class GuestbookPost extends AppModel {
	
	public $name = 'GuestbookPost';
	public $order = array('created' => 'desc');
	public $validate = array(
		'author' => array(
		        'rule' => 'notEmpty',
		        'message' => 'Please enter your name.',
		),
		'title' => array(
		        'rule' => 'notEmpty',
		        'message' => 'Please enter a title.',
		),
	    'text' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Please enter some text.',
		),
	);	
	
}
