<?php
/* Contents Test cases generated on: 2011-12-30 17:45:22 : 1325263522*/
App::uses('ContentsController', 'Controller');

/**
 * TestContentsController *
 */
class TestContentsController extends ContentsController {
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
 * ContentsController Test Case
 *
 */
class ContentsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.content', 'app.container', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry', 'app.layout_type', 'app.plugin', 'app.permission', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Contents = new TestContentsController();
		$this->Contents->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contents);

		parent::tearDown();
	}

}
