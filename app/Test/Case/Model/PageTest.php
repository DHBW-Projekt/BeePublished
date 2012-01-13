<?php
/* Page Test cases generated on: 2011-12-30 13:33:03 : 1325248383*/
App::uses('Page', 'Model');

/**
 * Page Test Case
 *
 */
class PageTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry', 'app.container', 'app.layout_type', 'app.content', 'app.plugin', 'app.permission', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Page = ClassRegistry::init('Page');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Page);

		parent::tearDown();
	}

}
