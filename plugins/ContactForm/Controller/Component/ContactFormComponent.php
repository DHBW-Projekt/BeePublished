<?php

App::import('Vendor','recaptcha/recaptchalib');

class ContactFormComponent extends Component {

	//SET name
	public $name = 'ContactFormComponent';

	//Component
	var $components = array('BeeEmail', 'Config');

	/**
	 * Method to transfer data from plugin to CMS.
	 */
	public function getData($controller, $params, $url, $contentId, $myUrl)
	{
		//SET title
		$controller->set('title_for_layout', __('Contact Form'));
			
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
	public function send($controller, $url=null, $params=null, $myUrl=null) {
			
		//Attributes
		$data_error = false;
		$captcha_error = false;
		$mail_error = false;
		$input_error = false;
			
		//LOAD model
		$controller->loadModel("ContactForm.ContactRequest");
			
		//CHECK request and data
		if (!$controller->request->is('post') || !isset($controller->data['ContactForm'])){
			$data_error = true;
		}
			

		if(!$data_error){
				
			//VALIDATE data
			$controller->ContactRequest->set(array('name' => $controller->data['ContactForm']['name'],
													'email' => $controller->data['ContactForm']['email'],
													'subject' => $controller->data['ContactForm']['subject'],
													'body' => $controller->data['ContactForm']['body']

			));

			if($controller->ContactRequest->validates()){
				
				//VALIDATE captcha
				$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
				$resp = recaptcha_check_answer($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$controller->data['recaptcha_challenge_field'],
				$controller->data['recaptcha_response_field']
				);
				if($resp->is_valid){
					
					//CHECK recipient
					$mailaddress = $this->Config->getValue('email');
					if (isset ($mailaddress)){
						
						//SEND email
						if($this->BeeEmail->sendHtmlEmail($to = $mailaddress, $subject = 'Request through contact form', $viewVars = array(
																								'name' => $controller->data['ContactForm']['name'],
																							   'email' => $controller->data['ContactForm']['email'],
																							   'subject' => $controller->data['ContactForm']['subject'],
																							   'body' => $controller->data['ContactForm']['body'],
																							   'url' => 'localhost'), 
															$viewName = 'ContactForm.contact')){
							$controller->Session->setFlash('Thank you for your interest. Your request has been sent.', 'flash_success');
						}else{
							$mail_error = true;
						} //END send email
															
					}else{
						$mail_error = true;
					} //END check recipient
					
				}else{
					$captcha_error = true;
				} //END if captcha validates

			}else{
				$input_error = true;
			} //END if data validates
		
		} //END if data error

			
		//PRINT error messages
		if($data_error){
			$controller->Session->setFlash('You cannot send an empty contact form.', 'flash_failure');
		}
		
		if($input_error){
			$controller->Session->setFlash('Please fill out all mandatory fields correctly.', 'flash_failure');
		}
		
		if($captcha_error){
			$controller->Session->setFlash('Please fill out the CAPTCHA field.', 'flash_failure');
		}
		
		if($mail_error){
			$controller->Session->setFlash('An error occurred, your request could not be sent. Please contact an administrator.', 'flash_failure');
		}
			
		//RETURN data
		if($data_error || $input_error || $captcha_error || $mail_error){
			return array('data' => $controller->ContactRequest, 'Element' => 'request');
		}
			
		//REDIRECT
		$controller->redirect($myUrl);
	}
}