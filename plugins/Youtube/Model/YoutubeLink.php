<?php
App::uses('AppModel', 'Model');
/**
 * YoutubeLink Model
 *
 */
class YoutubeLink extends AppModel {

	public $name = 'YoutubeLink';
	public $validate = array(
		'url' => array(
			'url' => array(
				'rule' => array('url'),
				'message' => 'Please enter a valid URL.',
			),
		),
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("Youtube", $value, true));
	}
	
}
