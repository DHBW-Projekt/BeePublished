<?php
/* Content Test cases generated on: 2011-12-02 19:37:55 : 1322851075*/
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
	public $fixtures = array('app.content', 'app.container', 'app.layout_type', 'app.page', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

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
