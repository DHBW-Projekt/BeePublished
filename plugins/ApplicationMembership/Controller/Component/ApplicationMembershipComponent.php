<?php

class ApplicationMembershipComponent extends Component {
	
	public $uses = array('Sanitize');
	public $components = array('BeeEmail', 'PermissionValidation');
	
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
	public function send($controller, $url=null, $params=null, $myUrl=null){
		
		//Attributes
		$data_error = false;
		
		//LOAD model
		$controller->loadModel("ApplicationMembership.ApplicationMembership");
		
		//CHECK request and data
		if (!$controller->request->is('post') || !isset($controller->data['ApplicationMembership']))
			$data_error = true;

		//VALIDATE data
		if(!$data_error){
			$controller->ApplicationMembership->set($controller->data['ApplicationMembership']);
		
			if(!$controller->ApplicationMembership->validates())
				$data_error = true;
		}
		
		//SEND email
		if(!$data_error){
			$this->BeeEmail->sendHtmlEmail($to = 'maximilian.stueber@me.com',
			$subject = 'New Application for Membership',
			$viewVars = array('data' => $controller->data['ApplicationMembership'], 'url' => 'localhost'),
			$viewName = 'ApplicationMembership.application');
		}
		 
		//SAVE in db
		if(!$data_error){
			$data_error = !$controller->ApplicationMembership->save($controller->data['ApplicationMembership']);
		}

		//PRINT error messages
		if(!$data_error)
			$controller->Session->setFlash('Thank you for your interest. Your request has been sent.');
		else
			$controller->Session->setFlash('Please fill out all mandatory fields.', 'default', array(
						'class' => 'flash_failure'));
		
		//RETURN DATA
		if($data_error)
			return array('data' => $controller->ApplicationMembership, 'Element' => 'request');
		
		//REDIRECT
		$controller->redirect($myUrl);
	}
}