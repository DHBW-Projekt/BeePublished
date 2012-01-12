<?php

class NewsletterRecipientsController extends AppController {
	var $layout = 'overlay';
	public $uses = array('Newsletter.NewsletterRecipient', 'User');
	
	
	public $paginate = array(
			 'NewsletterRecipient' => array(
				'limit' => 10,
				'order'	=> array(
					'NewsletterRecipient.email' => 'asc'),
				'conditions' => array(
					'NewsletterRecipient.active' => 1)),
	);
	
	public function index(){
		// prepare paginator
// 		$recipients = $this->paginate('NewsletterRecipient');
		$recipients = $this->NewsletterRecipient->find('all', array(
			'order' => array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1)));
		$this->set('recipients', $recipients);
	}
	
	public function delete($id){
		$recipient = $this->NewsletterRecipient->findById($id);
		// delete = set recipient inactive
		$recipient['NewsletterRecipient']['active'] = NULL;
		// save updated recipient
		$this->NewsletterRecipient->set($recipient);
		$this->NewsletterRecipient->save();
		$this->redirect($this->referer());
	}
	
	public function add(){
		if ($this->request->is('post')){
// 			debug($this->data);
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
					$this->Session->setFlash('The user was added successfully.', 'default', array(
						'class' => 'flash_success'), 
						'NewsletterRecipient');
				} else {
					$this->Session->setFlash('The user was removed successfully.', 'default', array(
						'class' => 'flash_success'), 
					'NewsletterRecipient');
				}
			} else {
				$this->Session->setFlash('The user was not added.', 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterRecipient');
				$this->_persistValidation('NewsletterRecipient');
			}
		}
		$this->redirect($this->referer());
	}
	
// 	public function guestUnSubscribe(){
// 		if ($this->request->is('post')){
// 			// check if recipient exists
// // 			debug($this->request->data);
// 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
// // 			if($recipient = $this->getRecipientByEmail($this->request->data['NewsletterRecipient']['email'])){
// 				// check if recipient is active
// 				if($recipient['NewsletterRecipient']['active'] == 1){
// // 				if($this->checkRecipientIsActive($recipient)){
// 					// inactivate recipient
// 					$recipient['NewsletterRecipient']['active'] = 0;
// 					$action = 'delete';
// 				} else {
// 					// else activate recipient
// 					$recipient['NewsletterRecipient']['active'] = 1;
// 					$action = 'add';
// 				}
// 				$this->NewsletterRecipient->set($recipient);
// 				if($this->NewsletterRecipient->save()) {
// 					if ($action == 'add'){
// 						$this->Session->setFlash('The user was added successfully.', 'default', array(
// 									'class' => 'flash_success'), 
// 									'NewsletterRecipient');
// 					} else {
// 						$this->Session->setFlash('The user was removed successfully.', 'default', array(
// 								'class' => 'flash_success'), 
// 								'NewsletterRecipient');
// 					}
// 				} else {
// 					$this->Session->setFlash('The user was not added.', 'default', array(
// 							'class' => 'flash_failure'), 
// 							'NewsletterRecipient');
// 					$this->_persistValidation('NewsletterRecipient');
// 				}
// 			} else {
// 				// if recipient doesn't exist, create a new one
// 				$this->add();
// 			}
// 		}
// 		// get back to calling page
// 		$this->redirect($this->referer());
// 	}
	
// 	public function userUnSubscribe(){
// 		if ($this->request->is('post')){
// 			$user = $this->Auth->user();
// 			// check if user is already recipient (active or inactive)
// 			if($recipient = $this->NewsletterRecipient->findByUser_id($user['id'])){
// 				// check if recipient is active
// 			if($recipient['NewsletterRecipient']['active'] == 1){
// 					// inactivate recipient
// 					$recipient['NewsletterRecipient']['active'] = 0;
// 					$action = 'delete';
// 				} else {
// 					// else activate recipient
// 					$recipient['NewsletterRecipient']['active'] = 1;
// 					$action = 'add';
// 				}
// 			} else {
// 				// if recipient doesn't exist, create a new one
// 				$recipient = array(
// 										'NewsletterRecipient' => array(
// 											'email' => $user['email'],
// 											'user_id' => $user['id'],
// 											'active' => '1'));
// 				$action = 'add';
// 			}
							
// 			// update or save recipient
// 			$this->NewsletterRecipient->set($recipient);
// 				if($this->NewsletterRecipient->save()) {
// 					if ($action == 'add'){
// 						$this->Session->setFlash('The user was added successfully.', 'default', array(
// 									'class' => 'flash_success'), 
// 									'NewsletterRecipient');
// 					} else {
// 						$this->Session->setFlash('The user was removed successfully.', 'default', array(
// 								'class' => 'flash_success'), 
// 								'NewsletterRecipient');
// 					}
// 				} else {
// 					$this->Session->setFlash('The user was not added.', 'default', array(
// 							'class' => 'flash_failure'), 
// 							'NewsletterRecipient');
// 					$this->_persistValidation('NewsletterRecipient');
// 		}
// 		$this->redirect($this->referer());
// 	}
// 	}
}

