<?php
/* File Test cases generated on: 2011-12-15 09:49:50 : 1323938990*/
App::uses('File', 'Model');

/**
 * File Test Case
 *
 */
class FileTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->File = ClassRegistry::init('File');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->File);

		parent::tearDown();
	}

}
