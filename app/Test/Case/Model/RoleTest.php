<?php
/* Role Test cases generated on: 2011-12-01 17:43:36 : 1322757816*/
App::uses('Role', 'Model');

/**
 * Role Test Case
 *
 */
class RoleTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.role', 'app.menu_entry', 'app.page', 'app.container', 'app.layout', 'app.layout_type', 'app.content', 'app.user');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Role = ClassRegistry::init('Role');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Role);

		parent::tearDown();
	}

}
