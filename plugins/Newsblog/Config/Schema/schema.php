<?php 
/* Newsblog schema generated on: 2012-01-12 20:50:32 : 1326397832*/
class NewsblogSchema extends CakeSchema {
	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $news_entries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'author_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'content_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'subtitle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'text' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'createdOn' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'publishedOn' => array('type' => 'date', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'publishedBy' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'lastModifiedOn' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'lastModifiedBy' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'validFrom' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'validTo' => array('type' => 'datetime', 'null' => false, 'default' => '9999-12-31 23:59:59', 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
}
?>