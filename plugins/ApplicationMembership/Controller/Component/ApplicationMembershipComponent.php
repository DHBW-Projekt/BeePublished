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
 * @author Yvonne Laier and Maximilian Stueber
 *
 * @description Component Controller for MemberApp.
 */

App::uses('Sanitize', 'Utility');
App::import('Vendor','recaptcha/recaptchalib');

class ApplicationMembershipComponent extends Component {
	
	public $components = array('BeeEmail', 'PermissionValidation', 'Config');
	
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
		$error_message = null;
		
		//LOAD model
		$controller->loadModel("ApplicationMembership.ApplicationMembership");
		
		//CHECK request and data
		if (!$controller->request->is('post') || !isset($controller->data['ApplicationMembership']))
			$data_error = true;
	
		//SANITIZE
		$lastname_clean = Sanitize::html($controller->data['ApplicationMembership']['last_name']);
		$firstname_clean = Sanitize::html($controller->data['ApplicationMembership']['first_name']);
		$email_clean = Sanitize::html($controller->data['ApplicationMembership']['email']);
		$telephone_clean = Sanitize::html($controller->data['ApplicationMembership']['telephone']);
		$street_clean = Sanitize::html($controller->data['ApplicationMembership']['street']);
		$zip_clean = Sanitize::html($controller->data['ApplicationMembership']['zip']);
		$city_clean = Sanitize::html($controller->data['ApplicationMembership']['city']);
		$comment_clean = Sanitize::html($controller->data['ApplicationMembership']['comment']);
		
		//VALIDATE data
		if(!$data_error){
			
			//SET input data
			$controller->ApplicationMembership->set(array(
						'type' => $controller->data['ApplicationMembership']['type'],
						'title' => $controller->data['ApplicationMembership']['title'],
						'last_name' => $lastname_clean,
						'first_name' => $firstname_clean,
						'date_of_birth' => $controller->data['ApplicationMembership']['date_of_birth'],
						'email' => $email_clean,
						'telephone' => $telephone_clean,
						'street' => $street_clean,
						'zip' => $zip_clean,
						'city' => $city_clean,
						'comment' => $comment_clean,
			));
		
			if(!$controller->ApplicationMembership->validates()){
				$data_error = true;
				$error_message = __d('application_membership', 'Please fill out all mandatory fields.');
			}
		}
		
		//CAPTCHA
		if(!$data_error){
			//GET captcha
			$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
			$resp = recaptcha_check_answer( $privatekey,
											$_SERVER["REMOTE_ADDR"],
											$controller->data['recaptcha_challenge_field'],
											$controller->data['recaptcha_response_field']
			);
		
			//VALIDATE CAPTCHA
			if(!$resp->is_valid){
				$error_message = __d('application_membership', 'Please fill out the CAPTCHA field.');
				$data_error = true;
			}
		}
			
		//VALIDATE mail
		if(!$data_error){	
			//GET recipient
			$mailaddress = $this->Config->getValue('email');
					
			//VALIDATE recipient
			if (empty ($mailaddress)){
				$error_message = __d('application_membership', 'An error occurred, your request could not be sent. Please contact an administrator.');
				$data_error = true;
			}
		}
		
		//SEND email
		if(!$data_error){
			$this->BeeEmail->sendHtmlEmail(
				$to = $mailaddress,
				$subject = 'New Application for Membership',
				$viewVars = array('data' => $controller->ApplicationMembership->data['ApplicationMembership'], 'url' => $this->Config->getValue('page_name')),
				$viewName = 'ApplicationMembership.application'
			);
		}
		 
		//SAVE in db
		if(!$data_error){
			$data_error = !$controller->ApplicationMembership->save();
		}

		//PRINT error messages
		if(!$data_error)
			$controller->Session->setFlash(__d('application_membership', 'Thank you for your interest. Your request has been sent.'));
		else
			$controller->Session->setFlash($error_message, 'default', array(
						'class' => 'flash_failure'));
		
		//RETURN DATA
		if($data_error)
			return array('data' => $controller->ApplicationMembership, 'Element' => 'request');
		
		//REDIRECT
		$controller->redirect($myUrl);
	}
}