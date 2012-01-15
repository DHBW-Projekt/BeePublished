<?php
class ApplicationForMembershipController extends AppController {

	/*public $name = 'ApplicationForMembership';*/
	public $uses = array('ApplicationForMembership','Sanitize');
	public $components = array('PermissionValidation');
	
	public function send(){
	
		//CHECK request
		if ($this->request->is('post')){
			
			//Attribute
			$form_error = false;
			
			//LOAD model
			$this->loadModel('ApplicationForMembership');
			
			//GET data
			$data = $this->request->data;
			
			//VALIDATES user input
			if(!$this->ApplicationForMembership->validates()){
				$form_error = true;
				
				//some error handling should be here ....
			}
			
			
			//DELETE code injections
			if(!$form_error){
				App::uses('Sanitize','Utility');
				$data = Sanitize::clean($data);
			}
			//CREATE mail
			if(!$form_error){
				//BUILD mail
				App::uses('CakeEmail', 'Network/Email');
				//CakeEmail::deliver('you@example.com', 'Subject', 'Message', array('from' => 'me@example.com'));
				
				//$email = new CakeEmail();
				//$email->template('ApplicationForMembership.application', 'email');
				//$email->emailFormat('text');
				//$email->to('yvonnelaier@gmx.de');
			    //$email->from('noreply@dualoncms.de');
				//$email->subject('New Application for Membership');
			   	
			   	//$email->send('Testinhalt');
				//->viewVars(array('data' => $data,'url' => 'localhost'))
			}
			
			//SAVE in db
			/*if ($controller->ApplicationForMembership->save($controller->request->data)) {
				$controller->Session->delete('input');
				$controller->_deleteValidation();
				$controller->Session->setFlash(__('Your application for membership was sent. You are going to be contacted by a responsible person.'), 'default', array('class' => 'flash_success'), 'ApplicationForMembership');
				$controller->redirect($controller->referer());
			}
			$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'ApplicationForMembership');
			$this->_persistValidation('ApplicationForMembership');
			$this->Session->write('input', $this->request->data);*/
			
			//REDIRECT
			$this->redirect($this->referer());
		}
	}
	
}

