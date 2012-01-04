<?php

class SubscriptionController extends AppController {
		
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient');

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('*'); 
	}
	
	public function admin($contentID){
// 		$this->loadModel("ContentValues");
		
	}	
	
	public function subscribe() {
	
		debug($this->request->data, $showHTML = false, $showFrom = true);	
		if ($this->request->is('post')){
			$this->NewsletterRecipient->set(array(
				'email' => $this->request->data['NewsletterRecipient']['email'],
				'user_id' => '2',
				'active' => '1'));
			if($this->NewsletterRecipient->save()) {
				$this->Session->setFlash('The user was added successfully.', 'default', array('class' => 'flash_success'), 'NewsletterRecipient');
				$this->_deleteValidation();
			} else {
				$this->Session->setFlash('The user was not added.', 'default', array('class' => 'flash_failure'), 'NewsletterRecipient');
				$this->_persistValidation('NewsletterRecipient');
			}
		}
		$this->redirect($this->referer());
	}
}