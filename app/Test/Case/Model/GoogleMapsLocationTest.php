<?php
/* GoogleMapsLocation Test cases generated on: 2011-12-06 00:07:46 : 1323126466*/
App::uses('GoogleMapsLocation', 'Model');

/**
 * GoogleMapsLocation Test Case
 *
 */
class GoogleMapsLocationTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.google_maps_location');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->GoogleMapsLocation = ClassRegistry::init('GoogleMapsLocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GoogleMapsLocation);

		parent::tearDown();
	}

}
