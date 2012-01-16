<?php
/* CMSPlugin Test cases generated on: 2011-12-06 07:24:51 : 1323152691*/
App::uses('CMSPlugin', 'Controller/Component');

/**
 * CMSPlugin Test Case
 *
 */
class CMSPluginTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.page', 'app.container', 'app.layout_type', 'app.content', 'app.user', 'app.role', 'app.menu_entry', 'app.log_entry');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->CMSPlugin = new CMSPlugin();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CMSPlugin);

		parent::tearDown();
	}

}
