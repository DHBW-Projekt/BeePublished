<?php
/* ContentValue Test cases generated on: 2011-12-06 11:46:20 : 1323168380*/
App::uses('ContentValue', 'Model');

/**
 * ContentValue Test Case
 *
 */
class ContentValueTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.content_value', 'app.content', 'app.container', 'app.layout_type', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->ContentValue = ClassRegistry::init('ContentValue');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->ContentValue);

		parent::tearDown();
	}

}
