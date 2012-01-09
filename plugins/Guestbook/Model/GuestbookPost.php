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
		        'message' => 'Bitte geben Sie Ihren Namen ein!',
		),
		'title' => array(
		        'rule' => 'notEmpty',
		        'message' => 'Bitte geben Sie einen Titel ein!',
		),
	    'text' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Bitte geben Sie einen Text ein!',
		),
	);	
	
}
