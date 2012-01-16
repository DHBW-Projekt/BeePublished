<?php
/* MenuEntries Test cases generated on: 2011-12-06 17:07:59 : 1323187679*/
App::uses('MenuEntriesController', 'Controller');

/**
 * TestMenuEntriesController *
 */
class TestMenuEntriesController extends MenuEntriesController {
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
 * MenuEntriesController Test Case
 *
 */
class MenuEntriesControllerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.menu_entry', 'app.role', 'app.user', 'app.log_entry', 'app.page', 'app.container', 'app.layout_type', 'app.content', 'app.content_value');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->MenuEntries = new TestMenuEntriesController();
		$this->MenuEntries->constructClasses();
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->MenuEntries);

		parent::tearDown();
	}

	/**
	 * testAdminIndex method
	 *
	 * @return void
	 */
	public function testAdminIndex() {

	}

	/**
	 * testAdminView method
	 *
	 * @return void
	 */
	public function testAdminView() {

	}

	/**
	 * testAdminAdd method
	 *
	 * @return void
	 */
	public function testAdminAdd() {

	}

	/**
	 * testAdminEdit method
	 *
	 * @return void
	 */
	public function testAdminEdit() {

	}

	/**
	 * testAdminDelete method
	 *
	 * @return void
	 */
	public function testAdminDelete() {

	}

}
