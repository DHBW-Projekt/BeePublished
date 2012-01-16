<?php
/* Plugins Test cases generated on: 2011-12-06 07:24:10 : 1323152650*/
App::uses('PluginsController', 'Controller');

/**
 * TestPluginsController *
 */
class TestPluginsController extends PluginsController {
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
 * PluginsController Test Case
 *
 */
class PluginsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.plugin');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Plugins = new TestPluginsController();
		$this->Plugins->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Plugins);

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
 * testInstall method
 *
 * @return void
 */
	public function testInstall() {

	}

/**
 * testUninstall method
 *
 * @return void
 */
	public function testUninstall() {

	}

}
