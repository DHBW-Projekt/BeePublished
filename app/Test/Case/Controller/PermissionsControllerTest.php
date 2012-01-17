<?php
/* Permissions Test cases generated on: 2012-01-15 21:09:48 : 1326658188*/
App::uses('PermissionsController', 'Controller');

/**
 * TestPermissionsController *
 */
class TestPermissionsController extends PermissionsController {
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
 * PermissionsController Test Case
 *
 */
class PermissionsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.permission', 'app.plugin', 'app.plugin_view', 'app.content', 'app.container', 'app.page', 'app.menu_entry', 'app.role', 'app.user', 'app.log_entry', 'app.layout_type', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Permissions = new TestPermissionsController();
		$this->Permissions->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permissions);

		parent::tearDown();
	}

}
