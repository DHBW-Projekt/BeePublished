<?php

class ContactFormComponent extends Component {
	
	//SET name
    public $name = 'ContactFormComponent';
    
    //Component
    var $components = array('BeeEmail', 'Recaptcha');

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
    	
    	//Recaptcha
    	$data['Recaptcha']['publickey'] = "6LeXXMwSAAAAAATYW9zan7IB7yaIKmx1VPMjqeXX";
    	$data['Recaptcha']['privatekey'] = "6LeXXMwSAAAAALTEji2U_qC9lp4W38_QxC0zfhgX";
    	
    	//$this->Recaptcha->publickey = "6LeXXMwSAAAAAATYW9zan7IB7yaIKmx1VPMjqeXX";
    	//$this->Recaptcha->privatekey = "6LeXXMwSAAAAALTEji2U_qC9lp4W38_QxC0zfhgX";
    
    	//RETURN data
    	if (!isset($data['data'])) {
    		$data['data'] = null;
    	}
    		
    	return $data;
    }
    
   /**
    * Function sendForm.
    */
    public function sendForm($controller, $url=null) {
    	
    	//Attributes
    	$data_error = false;
    	
    	//LOAD model
    	$controller->loadModel("ContactForm.ContactRequest");

    	//CHECK request and data
    	if (!$controller->request->is('post') || !isset($controller->data['ContactForm']))
    		$data_error = true;
    	
    	//CHECK recaptcha
    	/*if(!$this->Recaptcha->valid($controller->params['form'])){
    	 $data_error = true;
    	}*/

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

    	//SEND email
    	if(!$data_error){
    		$this->BeeEmail->sendHtmlEmail($to = 'maximilian.stueber@me.com',
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
    	
    	//REDIRECT
    	$controller->redirect('/contact');
    } 
} 