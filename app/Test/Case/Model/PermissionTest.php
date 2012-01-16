<?php
/* Permission Test cases generated on: 2011-12-19 09:25:33 : 1324283133*/
App::uses('Permission', 'Model');

/**
 * Permission Test Case
 *
 */
class PermissionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.permission', 'app.plugin', 'app.content', 'app.container', 'app.layout_type', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry', 'app.content_value');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Permission = ClassRegistry::init('Permission');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permission);

		parent::tearDown();
	}

}
