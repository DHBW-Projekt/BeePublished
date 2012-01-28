<?php
/* EmailTemplate Test cases generated on: 2012-01-16 23:39:23 : 1326753563*/
App::uses('EmailTemplate', 'Model');

/**
 * EmailTemplate Test Case
 *
 */
class EmailTemplateTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.email_template');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->EmailTemplate = ClassRegistry::init('EmailTemplate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmailTemplate);

		parent::tearDown();
	}

}
