<?php

App::import('Vendor','recaptcha/recaptchalib');

class ContactFormComponent extends Component {
	
	//SET name
    public $name = 'ContactFormComponent';
    
    //Component
    var $components = array('BeeEmail');

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
    public function send($controller, $url=null) {
    	
    	//Attributes
    	$data_error = false;
    	
    	//LOAD model
    	$controller->loadModel("ContactForm.ContactRequest");

    	//CHECK request and data
    	if (!$controller->request->is('post') || !isset($controller->data['ContactForm']))
    		$data_error = true;
    	

    	//VALIDATE data
    	if(!$data_error){
    		$controller->ContactRequest->set(array('name' => $controller->data['ContactForm']['name'],
    											   'email' => $controller->data['ContactForm']['email'],
    											   'subject' => $controller->data['ContactForm']['subject'],
    											   'body' => $controller->data['ContactForm']['body']
    										
    		));

    		if(!$controller->ContactRequest->validates())
    			$data_error = true;
    	}
    	
    	//VALIDATE captcha
    	$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
    	$resp = recaptcha_check_answer($privatekey,
    								   $_SERVER["REMOTE_ADDR"],
								       $_POST["recaptcha_challenge_field"],
								       $_POST["recaptcha_response_field"]);
    	
    	if ($resp->is_valid) {
    		$data_error = true;
    	}

    	//SEND email
    	if(!$data_error){
    		$this->BeeEmail->sendHtmlEmail($to = 'corinna.knick@yahoo.de',
    									   $subject = 'Request through contact form',
    									   $viewVars = array('name' => $controller->data['ContactForm']['name'],
																	   'email' => $controller->data['ContactForm']['email'],
																	   'subject' => $controller->data['ContactForm']['subject'],
																	   'body' => $controller->data['ContactForm']['body']
														     ),
										   $viewName = 'ContactForm.contact');
    	}
    	
    	//PRINT error messages
    	if(!$data_error)
    		$controller->Session->setFlash('Thank you for your interest. Your request has been sent.');
    	else
    		$controller->Session->setFlash('Please fill out all mandatory fields.');
    	
    	//RETURN data
    	if($data_error)
    		return array('data' => $controller->ContactRequest, 'Element' => 'request');
    	
    	//REDIRECT
    	$controller->redirect(/*$url.*/'/contact-form');
    } 
} 