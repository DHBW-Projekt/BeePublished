<?php
/* Container Test cases generated on: 2011-12-01 17:40:22 : 1322757622*/
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
	public $fixtures = array('app.container', 'app.layout', 'app.content', 'app.page');

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
