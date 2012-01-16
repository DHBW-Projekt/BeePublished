<?php
/* LayoutType Test cases generated on: 2011-12-02 19:43:20 : 1322851400*/
App::uses('LayoutType', 'Model');

/**
 * LayoutType Test Case
 *
 */
class LayoutTypeTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.layout_type', 'app.container', 'app.content', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->LayoutType = ClassRegistry::init('LayoutType');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->LayoutType);

		parent::tearDown();
	}

}
