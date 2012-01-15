<?php
class MailAddress extends AppModel {

	public $name = 'MailAddress';

	public $validate = array(
		'mailaddress' => array(
			'rule' => array('notEmpty', 'email'),
			'message' => 'Please enter a valid e-mail address.'
		)
	);
}
?>