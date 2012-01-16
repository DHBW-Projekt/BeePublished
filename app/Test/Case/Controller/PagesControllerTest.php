<?php
/* Pages Test cases generated on: 2011-12-06 07:24:26 : 1323152666*/
App::uses('PagesController', 'Controller');

/**
 * TestPagesController *
 */
class TestPagesController extends PagesController {
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
 * PagesController Test Case
 *
 */
class PagesControllerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.page', 'app.container', 'app.layout_type', 'app.content', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Pages = new TestPagesController();
		$this->Pages->constructClasses();
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Pages);

		parent::tearDown();
	}

	/**
	 * testDisplay method
	 *
	 * @return void
	 */
	public function testDisplay() {

	}

}
