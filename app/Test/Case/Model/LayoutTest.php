<?php
/* Layout Test cases generated on: 2011-12-01 17:41:53 : 1322757713*/
App::uses('Layout', 'Model');

/**
 * Layout Test Case
 *
 */
class LayoutTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.layout', 'app.container', 'app.content', 'app.page', 'app.layout_type');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Layout = ClassRegistry::init('Layout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Layout);

		parent::tearDown();
	}

}
