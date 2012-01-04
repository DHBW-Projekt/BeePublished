<?php
/* Containers Test cases generated on: 2011-12-30 14:29:25 : 1325251765*/
App::uses('Containers', 'Controller');

/**
 * TestContainers *
 */
class TestContainers extends Containers {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * Containers Test Case
 *
 */
class ContainersTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Containers = new TestContainers();
		$this->->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Containers);

		parent::tearDown();
	}

}
