<?php
/* GuestbookEntry Test cases generated on: 2011-12-05 15:21:39 : 1323094899*/
App::uses('GuestbookEntry', 'Guestbook.Model');

/**
 * GuestbookEntry Test Case
 *
 */
class GuestbookEntryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.guestbook.guestbook_entry');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->GuestbookEntry = ClassRegistry::init('GuestbookEntry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GuestbookEntry);

		parent::tearDown();
	}

}
