<?php
/* MenuEntry Test cases generated on: 2011-12-30 13:34:27 : 1325248467*/
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
	public $fixtures = array('app.menu_entry', 'app.role', 'app.user', 'app.log_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content', 'app.plugin', 'app.permission', 'app.content_value');

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
