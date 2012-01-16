<?php
/* Module Test cases generated on: 2011-12-02 22:28:44 : 1322861324*/
App::uses('Module', 'Model');

/**
 * Module Test Case
 *
 */
class ModuleTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.module');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Module = ClassRegistry::init('Module');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Module);

		parent::tearDown();
	}

}
