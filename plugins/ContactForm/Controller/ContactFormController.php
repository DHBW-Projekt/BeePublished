<?php
App::uses('CakeEmail', 'Network/Email');

/**
 * ContactFormController
 *
 * @author Corinna Knick
 */
class ContactFormController extends AppController {
	
	//SET name
	public $name = 'ContactForm';
	
	//LOAD helpers
	//public $helpers = array ('Recaptcha'); /*'Html','Form',*/
	
	//LOAD components
	//var $components = array('Recaptcha');  /*'ContactFormComponent'*/
	
	//LOAD elements
	//var $uses = array('ContactForm','MailAddress');
	
	/*public function saveaddress(){
		if ($this->MailAddress->validates()) {
			if ($this->MailAddress->save($this->data)) {
				//soll mailaddress-Wert in Tabelle �berspeichern -> wie?
				$this->Session->setFlash('The e-mail address has been saved.');
			}else{
				$this->Session->setFlash('An error occured. The e-mail address could not be saved.');
			}
		}
	}*/
	
   /**
	* Before-Filter function
	*/
	function beforeFilter(){
		//Recaptcha
    	$this->Recaptcha->publickey = "6LeXXMwSAAAAAATYW9zan7IB7yaIKmx1VPMjqeXX";
    	$this->Recaptcha->privatekey = "6LeXXMwSAAAAALTEji2U_qC9lp4W38_QxC0zfhgX";
    	
    	//Permissions
    	$this->Auth->allow('*');
	}	
}