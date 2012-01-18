<?php

App::uses('CakeEmail', 'Network/Email');
Configure::write('Config.language', 'ger');

class SubscriptionController extends AppController {
	
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'User', 'Newsletter.NewsletterLetter');
 	
// 	public $paginate = array(
// 				'NewsletterLetter' => array(
// 					'limit' => 10, 
// 					'order' => array(
// 						'NewsletterLetter.date' => 'desc',
// 						'NewsletterLetter.id' => 'desc')));
	
 	public function admin($contentID){
//  		$newsletters = $this->paginate('NewsletterLetter');
 		$newsletters = $this->NewsletterLetter->find('all', array(
 			'order' => array(
 									'NewsletterLetter.date' => 'desc',
 									'NewsletterLetter.id' => 'desc')));
 		$this->set('newsletters', $newsletters);
 		$this->layout = 'overlay';
 		$this->set('contentID', $contentID);
 		$this->render('/NewsletterLetters/index');
 	}
 	
 	public function guestUnSubscribe(){
 		if ($this->request->is('post')){
 			// check if recipient exists
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
 					$action = 'delete';
 				} else {
 					// else activate recipient
 					$recipient['NewsletterRecipient']['active'] = 1;
 					$action = 'add';
 				}
 				$this->NewsletterRecipient->set($recipient);
 				if($this->NewsletterRecipient->save()) {
 					if ($action == 'add'){
 						$this->Session->setFlash(__('The recipient was added successfully.'), 'default', array(
 										'class' => 'flash_success'), 
 										'NewsletterRecipient');
 					} else {
 						$this->Session->setFlash(__('The recipient was removed successfully.'), 'default', array(
 									'class' => 'flash_success'), 
 									'NewsletterRecipient');
 					}
 				} else {
 					$this->Session->setFlash(__('The recipient was not added.'), 'default', array(
 								'class' => 'flash_failure'), 
 								'NewsletterRecipient');
 					$this->_persistValidation('NewsletterRecipient');
 				}
 			} else {
 				// if recipient doesn't exist, create a new one
 				$this->add();
 			}
 		}
 		// get back to calling page
 		$this->redirect($this->referer());
 	}
 	
 	public function userUnSubscribe(){
 		if ($this->request->is('post')){
 			$user = $this->Auth->user();
 			// check if user is already recipient (active or inactive)
 			if($recipient = $this->NewsletterRecipient->findByUser_id($user['id'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
 					$action = 'delete';
 				} else {
 					// else activate recipient
 					$recipient['NewsletterRecipient']['active'] = 1;
 					$action = 'add';
 				}
 			} else {
 				// if recipient doesn't exist, create a new one
 				$recipient = array(
 											'NewsletterRecipient' => array(
 												'email' => $user['email'],
 												'user_id' => $user['id'],
 												'active' => '1'));
 				$action = 'add';
 			}
 			// update or save recipient
 			$this->NewsletterRecipient->set($recipient);
 			if($this->NewsletterRecipient->save()) {
 				if ($action == 'add'){
 					$this->Session->setFlash(__('You have subscribed successfully.'), 'default', array(
 										'class' => 'flash_success'), 
 										'NewsletterRecipient');
 				} else {
 					$this->Session->setFlash('You have unsubscribed successfully.', 'default', array(
 									'class' => 'flash_success'), 
 									'NewsletterRecipient');
 				}
 			} else {
 				$this->Session->setFlash('The subscription was not successful.', 'default', array(
 								'class' => 'flash_failure'), 
 								'NewsletterRecipient');
 				$this->_persistValidation('NewsletterRecipient');
 			}
 			$this->redirect($this->referer());
 		}
 	}
 	
 	public function add(){
 		if ($this->request->is('post')){
 			$email = $this->data['NewsletterRecipient']['email'];
 			// check, if recipient already exists, but is inactive
 			$recipient = $this->NewsletterRecipient->findByEmail($email);
 			if (($recipient) && ($recipient['NewsletterRecipient']['active'] == 0)){
 				// set active
 				$recipient['NewsletterRecipient']['active'] = 1;
 			} else {
 				// create new recipient
 				// check, if recipient is user
 				$user = $this->User->findByEmail($email);
 				if(isset($user)){
 					$recipient = array(
 							'NewsletterRecipient' => array(
 								'email' => $email,
 								'user_id' => $user['User']['id'],
 								'active' => '1'));
 				} else {
 					$recipient = array(
 							'NewsletterRecipient' => array(
 								'email' => $email,
 								'user_id' => NULL,
 								'active' => '1'));
 				}
 			}
 			$action = 'add';
 			$this->NewsletterRecipient->set($recipient);
 			if($this->NewsletterRecipient->save()) {
 				if ($action == 'add'){
 					$this->Session->setFlash(__('The user was added successfully.'), 'default', array(
 							'class' => 'flash_success'), 
 							'NewsletterRecipient');
 				} else {
 					$this->Session->setFlash(__('The user was removed successfully.'), 'default', array(
 							'class' => 'flash_success'), 
 						'NewsletterRecipient');
 				}
 			} else {
 				$this->Session->setFlash(__('The user was not added.'), 'default', array(
 						'class' => 'flash_failure'), 
 						'NewsletterRecipient');
 				$this->_persistValidation('NewsletterRecipient');
 			}
 		}
 		$this->redirect($this->referer());
 	}

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
}