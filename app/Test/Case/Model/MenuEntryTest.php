<?php
/* MenuEntry Test cases generated on: 2011-12-01 17:42:51 : 1322757771*/
App::uses('MenuEntry', 'Model');

/**
 * MenuEntry Test Case
 *
 */
class MenuEntryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.menu_entry', 'app.role', 'app.page');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->MenuEntry = ClassRegistry::init('MenuEntry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuEntry);

		parent::tearDown();
	}

}
