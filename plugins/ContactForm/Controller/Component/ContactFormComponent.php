<?php

class ContactFormComponent extends Component {

    public $name = 'ContactFormComponent';
    
    public function getData($controller, $params){
    	$controller->set('title_for_layout', __('Contact Form'));
    	$controller->loadModel('ContactForm.MailAddress');
    	$mailaddress = $controller->MailAddress->find('first', array('conditions' => array('Mailaddress.id' => 1)));
        return $mailaddress;
        echo $mailaddress;
    }
    
    public function beforeFilter() {
    	$this->Auth->allow('*');
    }
   
} 