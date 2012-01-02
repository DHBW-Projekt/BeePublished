<?php
/* LayoutTypes Test cases generated on: 2012-01-01 10:31:20 : 1325410280*/
App::uses('LayoutTypesController', 'Controller');

/**
 * TestLayoutTypesController *
 */
class TestLayoutTypesController extends LayoutTypesController {
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
 * LayoutTypesController Test Case
 *
 */
class LayoutTypesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.layout_type', 'app.container', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry', 'app.content', 'app.plugin', 'app.permission', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->LayoutTypes = new TestLayoutTypesController();
		$this->LayoutTypes->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LayoutTypes);

		parent::tearDown();
	}

}
