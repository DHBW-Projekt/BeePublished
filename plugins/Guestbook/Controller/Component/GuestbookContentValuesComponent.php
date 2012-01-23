<?php

class GuestbookContentValuesComponent extends Component {
	
	public $components = array('ContentValueManager');
	
	public $defaults = array(
		'posts_per_page' => '10',
		'send_emails' => 'yes',
		'delete_immediately' => 'yes'
		);
	
	function getValue($contentId, $key){
		$contentValues = $this->ContentValueManager->getContentValues($contentId);
		if (array_key_exists($key, $contentValues)){
			return $contentValues[$key];
		} elseif (array_key_exists($key, $this->defaults)){
			return $this->defaults[$key];
		}
		throw InternalErrorException('GuestbookContentValuesComponent -> key not found');
	}
	
	
	
	
	
	
}