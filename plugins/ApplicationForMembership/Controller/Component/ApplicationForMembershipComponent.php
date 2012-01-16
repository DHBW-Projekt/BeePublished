<?php

class ApplicationForMembershipComponent extends Component {
	
	public $uses = array('Sanitize');
	public $components = array('PermissionValidation');
	
	
   /**
	* Method to transfer data from plugin to CMS.
	*/
	public function getData($controller, $params, $url, $contentId, $myUrl)
	{
		//CHECK url
		if (isset($url)){
			$data['Element'] = array_shift($url);
		} else {
			$data['Element'] = 'request';
		}
	
		//CALL corresponding comp. method
		if (method_exists($this, $data['Element'])){
			$func_data = $this->{$data['Element']}($controller, $url, $params, $myUrl);
			if (isset($func_data['data'])) {
				$data['data'] = $func_data['data'];
			}
			if (isset($func_data['Element'])) {
				$data['Element'] = $func_data['Element'];
			}
		}
	
		//RETURN data
		if (!isset($data['data'])) {
			$data['data'] = null;
		}
			
		return $data;
	}
	
	/**
	 * Function send.
	 */
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