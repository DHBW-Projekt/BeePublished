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
    		$data['Element'] = 'sendForm';
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
    * Function sendForm.
    */
    public function sendform($controller, $url=null) {
    	
    	//Attributes
    	$data_error = false;
    	
    	//LOAD model
    	$controller->loadModel("ContactForm");
    	
    	//CHECK request and data
    	if (!$controller->request->is('post') || !isset($controller->data))
    		return;
    	
    	//SET data
    	$controller->ContactForm->set($controller->data);
    	
    	//VALIDATE data
    	if(!$controller->ContactForm->validates())
    		$data_error = true;
    	
    	//CHECK recaptcha
    	if(!$this->Recaptcha->valid($controller->params['form'])){
    		$data_error = true;
    		$controller->Session->setFlash('Please fill out all mandatory fields.');
    	}
    	
    	//SEND email
    	if(!$data_error){
    		if ($this->BeeEmail->sendHtmlEmail($to = 'corinna.knick@yahoo.de',
    												 $subject = 'Request through contact form',
    												 $viewVars = array('name'=>$this->data['ContactForm']['firstname'].' '.$this->data['ContactForm']['lastname'],
																	   'email'=>$this->data['ContactForm']['email'],
																	   'subject'=>$this->data['ContactForm']['subject'],
																	   'body'=>$this->data['ContactForm']['body']
																	  ),
													 $viewName = 'ContactForm.contact'
			)){
    			$controller->Session->setFlash('Thank you for your interest. Your request has been sent.');
    		} else {
    			$controller->Session->setFlash('An error occured. Your request could not be sent. Please contact an administrator.');
    		}
    	}
    }
    
    /**
     * Before-Filter
     */
    public function beforeFilter() {
    	$this->Auth->allow('*');
    }
    
    /*  public function getData($controller, $params){
    	
    	$controller->loadModel('ContactForm.MailAddress');
    	$mailaddress = $controller->MailAddress->find('first', array('conditions' => array('Mailaddress.id' => 1)));
        return $mailaddress;
        echo $mailaddress;
    }*/
   
} 