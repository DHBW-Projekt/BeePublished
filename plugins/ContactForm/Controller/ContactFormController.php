<?php

App::uses('CakeEmail', 'Network/Email')

class ContactFormController extends AppController {
	public $helpers = array ('Html','Form','Recaptcha');
	public $name = 'ContactForm';
	var $components = array('Recaptcha', 'ContactFormComponent');
	var $uses = array('ContactForm','MailAddress');
	
	
	function beforeFilter(){
		$this->Auth->allow('*');
		$this->Recaptcha->publickey = "6LcWs8oSAAAAAITDX__bcN9xqCxRruyGFoJuh2w1";
		$this->Recaptcha->privatekey = "6LcWs8oSAAAAAKmeuaoHU5IVY3KjOzeiMsmYqe02";
	}
	
	public function sendform() {
		$this->ContactForm->set($this->data);
		if ($this->ContactForm->validates()) {
			if($this->Recaptcha->valid($this->params['form'])) {
				$email = new CakeEmail();
				$email->viewVars(array(
					'name'=>$this->data['ContactForm']['lastname'].' '.$this->data['ContactForm']['firstname'],
					'email'=>$this->data['ContactForm']['email'],
					'subject'=>$this->data['ContactForm']['subject'],
					'body'=>$this->data['ContactForm']['body']
				))
				$email->template('contact_form');
				$email->emailFormat('html');
				$email->to($mailaddress[MailAddress][mailaddress]);
				$email->from($this->data['ContactForm']['email']);
				$email->subject ('Request through contact form');
				
				if ($email->send()){
	            	$this->Session->setFlash('Thank you for your interest. Your request has been sent.');
	            } else {
	            	$this->Session->setFlash('An error occured. Your request could not be sent. Please contact an administrator.');
	            }
			}else{ 
				$this->Session->setFlash('Please enter the correct CAPTCHA code.');
			}
		}else{
			$this->Session->setFlash('Please fill out all mandatory fields.');
		}
	}
		
}