<?php 
/* Youtube schema generated on: 2012-01-26 17:09:43 : 1327594183*/
class YoutubeSchema extends CakeSchema {
	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}
	
	var $youtube_links = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'contentId' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'url' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}
?>