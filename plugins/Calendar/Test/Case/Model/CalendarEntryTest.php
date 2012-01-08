<?php
/* CalendarEntry Test cases generated on: 2012-01-07 07:31:18 : 1325917878*/
App::uses('CalendarEntry', 'Model');

/**
 * CalendarEntry Test Case
 *
 */
class CalendarEntryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.calendar_entry', 'app.user', 'app.role', 'app.menu_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content', 'app.plugin_view', 'app.plugin', 'app.permission', 'app.content_value', 'app.log_entry');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->CalendarEntry = ClassRegistry::init('CalendarEntry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CalendarEntry);

		parent::tearDown();
	}

}
