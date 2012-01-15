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
		//Recaptcha
		$this->Recaptcha->publickey = "6LeXXMwSAAAAAATYW9zan7IB7yaIKmx1VPMjqeXX";
		$this->Recaptcha->privatekey = "6LeXXMwSAAAAALTEji2U_qC9lp4W38_QxC0zfhgX";
		 
		//Permissions
		$this->Auth->allow('*');
	}
}