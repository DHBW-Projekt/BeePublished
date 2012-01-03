<?php
/* Content Test cases generated on: 2012-01-01 17:20:57 : 1325434857*/
App::uses('Content', 'Model');

/**
 * Content Test Case
 *
 */
class ContentTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.content', 'app.container', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry', 'app.layout_type', 'app.plugin_view', 'app.plugin', 'app.permission', 'app.plugin_view_value', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Content = ClassRegistry::init('Content');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Content);

		parent::tearDown();
	}

}
