<?php
/* CalendarEntries Test cases generated on: 2012-01-08 18:04:35 : 1326042275*/
App::uses('CalendarEntriesController', 'Calendar.Controller');

/**
 * TestCalendarEntriesController *
 */
class TestCalendarEntriesController extends CalendarEntriesController {
	/**
	 * Auto render
	 *
	 * @var boolean
	 */
	public $autoRender = false;

	/**
	 * Redirect action
	 *
	 * @param mixed $url
	 * @param mixed $status
	 * @param boolean $exit
	 * @return void
	 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * CalendarEntriesController Test Case
 *
 */
class CalendarEntriesControllerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('plugin.calendar.calendar_entry', 'app.user', 'app.role', 'app.menu_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content', 'app.plugin_view', 'app.plugin', 'app.permission', 'app.content_value', 'app.log_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->CalendarEntries = new TestCalendarEntriesController();
		$this->CalendarEntries->constructClasses();
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->CalendarEntries);

		parent::tearDown();
	}

	/**
	 * testIndex method
	 *
	 * @return void
	 */
	public function testIndex() {

	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testView() {

	}

	/**
	 * testAdd method
	 *
	 * @return void
	 */
	public function testAdd() {

	}

	/**
	 * testEdit method
	 *
	 * @return void
	 */
	public function testEdit() {

	}

	/**
	 * testDelete method
	 *
	 * @return void
	 */
	public function testDelete() {

	}

}
