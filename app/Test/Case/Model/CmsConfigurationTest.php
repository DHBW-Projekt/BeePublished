<?php
/* CmsConfiguration Test cases generated on: 2011-12-02 20:07:18 : 1322852838*/
App::uses('CmsConfiguration', 'Model');

/**
 * CmsConfiguration Test Case
 *
 */
class CmsConfigurationTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.cms_configuration');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->CmsConfiguration = ClassRegistry::init('CmsConfiguration');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->CmsConfiguration);

		parent::tearDown();
	}

}
