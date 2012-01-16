<?php
/* Plugin Test cases generated on: 2012-01-01 17:19:18 : 1325434758*/
App::uses('Plugin', 'Model');

/**
 * Plugin Test Case
 *
 */
class PluginTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.plugin', 'app.permission', 'app.role', 'app.menu_entry', 'app.page', 'app.user', 'app.log_entry', 'app.container', 'app.layout_type', 'app.content', 'app.content_value', 'app.plugin_view');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Plugin = ClassRegistry::init('Plugin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Plugin);

		parent::tearDown();
	}

}
