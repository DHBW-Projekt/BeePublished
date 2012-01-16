<?php
/* LogEntry Fixture generated on: 2011-12-02 19:44:27 : 1322851467 */

/**
 * LogEntryFixture
 *
 */
class LogEntryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'ipaddress' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'action' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'actionDate' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'object_class' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'object_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'data' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'ipaddress' => 1,
			'action' => 1,
			'actionDate' => '2011-12-02 19:44:27',
			'object_class' => 'Lorem ipsum dolor sit amet',
			'object_id' => 1,
			'data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
