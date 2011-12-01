<?php
/* Content Test cases generated on: 2011-12-01 17:41:05 : 1322757665*/
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
	public $fixtures = array('app.content', 'app.container', 'app.layout', 'app.page');

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
