<?php
/* Container Test cases generated on: 2011-12-02 19:36:57 : 1322851017*/
App::uses('Container', 'Model');

/**
 * Container Test Case
 *
 */
class ContainerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.container', 'app.layout_type', 'app.content', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Container = ClassRegistry::init('Container');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Container);

		parent::tearDown();
	}

}
