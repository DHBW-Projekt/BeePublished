<?php
/* MenuEntry Test cases generated on: 2011-12-02 19:38:48 : 1322851128*/
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
	public $fixtures = array('app.menu_entry', 'app.role', 'app.user', 'app.log_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content');

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
