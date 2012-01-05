<?php

class SubscriptionController extends AppController {
		
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient');
	var $autoLayout = false;
	

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('*'); 
	}
	
	public function admin($contentID){
// 		$this->loadModel("ContentValues");
		
	}	
	
	public function content(){
		
	}
	
	public function subscribe() {
		debug($this->request->data, $showHTML = false, $showFrom = true);	
		if ($this->request->is('post')){
			$this->NewsletterRecipient->set(array(
				'email' => $this->request->data['Subscription']['email'],
				'user_id' => '2',
				'active' => '1'));
			$this->NewsletterRecipient->save();
			$this->redirect($this->referer());
		}	
			
//		$this->set('errors', $this->GuestbookPost->validationErrors);
		$this->redirect($this->referer());
	}







	
}