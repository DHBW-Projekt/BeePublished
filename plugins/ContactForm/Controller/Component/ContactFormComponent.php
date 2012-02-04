<?php
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Maximilian Stüber, Corinna Knick
*
* @description send method of contact form
*/
App::uses('Sanitize', 'Utility');
App::import('Vendor','recaptcha/recaptchalib');

class ContactFormComponent extends Component {

	//LOAD components
	var $components = array('BeeEmail', 'PermissionValidation', 'Config');

	/**
	* Method to transfer data from plugin to CMS.
	*/
	public function getData($controller, $params, $url, $contentId, $myUrl)
	{
		//SET title
		$controller->set('title_for_layout', __d('contact_form','Contact Form'));
			
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
			
		//LOAD model
		$controller->loadModel("ContactForm.ContactRequest");
			
		//CHECK request and data
		if (!$controller->request->is('post') || !isset($controller->data['ContactRequest'])){
			$controller->Session->setFlash(__d('contact_form','You cannot send an empty contact form.'), 'flash_failure');
			return array('data' => $controller->ContactRequest, 'Element' => 'request');
		}	
		
		//SANITIZE
		$controller->data =  Sanitize::clean($controller->data);

		//SET input data
		$controller->ContactRequest->set($controller->data['ContactRequest']);
		
		//VALIDATE input data
		if(!$controller->ContactRequest->validates()){
			$controller->Session->setFlash(__d('contact_form','Please fill out all mandatory fields correctly.'), 'flash_failure');
			return array('data' => $controller->ContactRequest, 'Element' => 'request');
		}
				
		//GET CAPTCHA
		$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
		$resp = recaptcha_check_answer( $privatekey,
										$_SERVER["REMOTE_ADDR"],
										$controller->data['recaptcha_challenge_field'],
										$controller->data['recaptcha_response_field']
		);
		
		//VALIDATE CAPTCHA
		if(!$resp->is_valid){
			$controller->Session->setFlash(__d('contact_form','Please fill out the CAPTCHA field correctly.'), 'flash_failure');
			return array('data' => $controller->ContactRequest, 'Element' => 'request');
		}
					
		//GET recipient
		$mailaddress = $this->Config->getValue('email');
					
		//VALIDATE recipient
		if (empty ($mailaddress)){
			$controller->Session->setFlash(__d('contact_form','An error occurred, your request could not be sent. Please contact an administrator.'), 'flash_failure');
			return array('data' => $controller->ContactRequest, 'Element' => 'request');
		}
						
		//SEND email
		$this->BeeEmail->sendHtmlEmail( $to = $mailaddress, 
										$subject = __d('contact_form','Request through contact form'), 
										$viewVars = array(  'name' => $controller->data['ContactRequest']['name'],
															'email' => $controller->data['ContactRequest']['email'],
															'subject' => $controller->data['ContactRequest']['subject'],
															'body' => $controller->data['ContactRequest']['body'],
															'url' => $this->Config->getValue('page_name')
										), 
										$viewName = 'ContactForm.contact'
		);
		$controller->Session->setFlash(__d('contact_form','Thank you for your interest. Your request has been sent.'), 'flash_success');
		
		//REDIRECT
		$controller->redirect($myUrl);
	}
}