<?php
/* Text Test cases generated on: 2011-12-05 22:23:51 : 1323120231*/
App::uses('Text', 'Model');

/**
 * Text Test Case
 *
 */
class TextTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.text');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Text = ClassRegistry::init('Text');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Text);

		parent::tearDown();
	}

}
