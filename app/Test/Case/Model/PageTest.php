<?php
/* Page Test cases generated on: 2011-12-02 19:31:26 : 1322850686*/
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
	public $fixtures = array('app.page', 'app.container', 'app.layout_type', 'app.content', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

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
