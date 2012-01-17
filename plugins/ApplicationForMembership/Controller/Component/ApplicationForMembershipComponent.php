<?php

App::import('Vendor','recaptcha/recaptchalib');
class ApplicationForMembershipComponent extends Component {
	
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
	public function send($controller, $url=null){
		
		//Attributes
		$data_error = false;
		
		//LOAD model
		$controller->loadModel("ApplicationForMembership.ApplicationMembership");
		
		//CHECK request and data
		if (!$controller->request->is('post') || !isset($controller->data['ApplicationMembership']))
			$data_error = true;

		//VALIDATE data
		if(!$data_error){
			$controller->ApplicationMembership->set($controller->data['ApplicationMembership']);
		
			if(!$controller->ApplicationMembership->validates())
				$data_error = true;
		}
		
		//VALIDATE captcha
		if(!$data_error){
		
			$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
		
			$resp = recaptcha_check_answer(	$privatekey,
											$_SERVER["REMOTE_ADDR"],
											$controller->data['recaptcha_challenge_field'],
											$controller->data['recaptcha_response_field']
			);
		
			if ($resp->is_valid) {
				$data_error = true;
			}
		}
		
		//SEND email
		if(!$data_error){
			$this->BeeEmail->sendHtmlEmail($to = 'maximilian.stueber@me.com',
			$subject = 'New Application for Membership',
			$viewVars = array('data' => $controller->data['ApplicationMembership'], 'url' => 'localhost'),
			$viewName = 'ApplicationForMembership.application');
		}
		 
		//SAVE in db
		if(!$data_error){
			$data_error = !$controller->ApplicationMembership->save($controller->data['ApplicationMembership']);
		}

		//PRINT error messages
		if(!$data_error)
			$controller->Session->setFlash('Thank you for your interest. Your request has been sent.');
		else
			$controller->Session->setFlash('Please fill out all mandatory fields.');
		
		//RETURN DATA
		if($data_error)
			return array('data' => $controller->ApplicationMembership, 'Element' => 'request');
		
		//REDIRECT
		$controller->redirect('/member-application');
	}
}