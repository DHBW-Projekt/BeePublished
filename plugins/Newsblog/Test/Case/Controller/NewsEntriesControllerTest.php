<?php
/* NewsEntries Test cases generated on: 2012-01-11 09:39:44 : 1326271184*/
App::uses('NewsEntriesController', 'Newsblog.Controller');

/**
 * TestNewsEntriesController *
 */
class TestNewsEntriesController extends NewsEntriesController {
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
 * NewsEntriesController Test Case
 *
 */
class NewsEntriesControllerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.news_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->NewsEntries = new TestNewsEntriesController();
		$this->NewsEntries->constructClasses();
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->NewsEntries);

		parent::tearDown();
	}

}
