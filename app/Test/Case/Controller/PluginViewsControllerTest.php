<?php
/* PluginViews Test cases generated on: 2012-01-01 17:35:13 : 1325435713*/
App::uses('PluginViewsController', 'Controller');

/**
 * TestPluginViewsController *
 */
class TestPluginViewsController extends PluginViewsController {
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
 * PluginViewsController Test Case
 *
 */
class PluginViewsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.plugin_view', 'app.plugin', 'app.permission', 'app.role', 'app.menu_entry', 'app.page', 'app.user', 'app.log_entry', 'app.container', 'app.layout_type', 'app.content', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->PluginViews = new TestPluginViewsController();
		$this->PluginViews->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PluginViews);

		parent::tearDown();
	}

}
