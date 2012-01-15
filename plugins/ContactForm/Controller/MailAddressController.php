<?php

class MailAddressController extends AppController{
	
	public $helpers = 'Form';
	public $name = 'MailAddress';
	var $uses = array('MailAddress');
	var $components = array('ContactFormComponent');
	
	function beforeFilter(){
		$this->Auth->allow('*');
	}
	
	public function saveaddress(){
		if ($this->MailAddress->validates()) {
            if ($this->MailAddress->save($this->data)) { //soll mailaddress-Wert in Tabelle überspeichern -> wie?
                $this->Session->setFlash('The e-mail address has been saved.');
            }else{
				$this->Session->setFlash('An error occured. The e-mail address could not be saved.');
			}	
		}
	}
}

?>