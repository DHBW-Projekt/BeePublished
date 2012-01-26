<?php
App::uses('AppModel', 'Model');
/**
 * GuestbookPost Model
 *
 */
class GuestbookPost extends AppModel {
	
	public $name = 'GuestbookPost';
	// show last post first
	public $order = array('created' => 'desc');
	// raise error if field is empty - Sanitize in GuestbookPostController is used to prevent harmful code injections etc.
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
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("Guestbook", $value, true));
	}
	
}
