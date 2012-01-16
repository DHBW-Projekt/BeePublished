<?php
/* NewsblogTitle Test cases generated on: 2012-01-13 08:18:11 : 1326439091*/
App::uses('NewsblogTitle', 'Model');

/**
 * NewsblogTitle Test Case
 *
 */
class NewsblogTitleTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.newsblog_title');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->NewsblogTitle = ClassRegistry::init('NewsblogTitle');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->NewsblogTitle);

		parent::tearDown();
	}

}
