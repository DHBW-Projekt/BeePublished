<?php
App::uses('CakeEmail', 'Network/Email');

/**
 * ContactFormController
 *
 * @author Corinna Knick
 */
class ContactFormController extends AppController {
	
   /**
	* Before-Filter
	*/
	public function beforeFilter() {		
		//Permissions
		$this->Auth->allow('*');
	}
}