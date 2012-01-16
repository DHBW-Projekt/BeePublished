<?php
/* LogEntry Test cases generated on: 2011-12-02 19:44:27 : 1322851467*/
App::uses('LogEntry', 'Model');

/**
 * LogEntry Test Case
 *
 */
class LogEntryTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.log_entry', 'app.user', 'app.role', 'app.menu_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->LogEntry = ClassRegistry::init('LogEntry');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->LogEntry);

		parent::tearDown();
	}

}
