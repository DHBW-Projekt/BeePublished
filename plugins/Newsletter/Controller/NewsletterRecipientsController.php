<?php

class NewsletterRecipientsController extends AppController {
	
	var $layout = 'overlay';
	
	public $uses = array('Newsletter.NewsletterRecipient', 'User');
		
	public function index($contentID){
		$recipients = $this->NewsletterRecipient->find('all', array(
			'order' => array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1))); 
		$this->set('recipients', $recipients);
		$this->set('contentID', $contentID);
	}
	
	public function delete($id){
		$recipient = $this->NewsletterRecipient->findById($id);
		// delete = set recipient inactive
		$recipient['NewsletterRecipient']['active'] = NULL;
		// save updated recipient
		$this->NewsletterRecipient->set($recipient);
		if($this->NewsletterRecipient->save()){
			$this->Session->setFlash(__('The recipient was deleted successfully.'), 'default', array(
				'class' => 'flash_success'), 
				'RecipientDeleted');
		} else {
			$this->Session->setFlash(__('The recipient couldn\'t be deleted.'), 'default', array(
				'class' => 'flash_failure'), 
				'RecipientDeleted');
		}
		$this->redirect($this->referer());
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
	
	public function deleteSelected($contentID){
		if ($this->request->is('post')){
			$recipients = $this->NewsletterRecipient->find('all', array(
			'order' => array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1))); 
			$selectedRecipients = $this->data['selectRecipients'];
			foreach($recipients as $recipient){
				$id = $recipient['NewsletterRecipient']['id'];
				if ($selectedRecipients[$id] == 1){
					// delete = set recipient inactive
					$recipient['NewsletterRecipient']['active'] = NULL;
					// save updated recipient
					$this->NewsletterRecipient->set($recipient);
					if($this->NewsletterRecipient->save()){
						$this->Session->setFlash(__('The selected recipients have been deleted successfully.'), 'default', array(
							'class' => 'flash_success'), 
							'RecipientDeleted');
					} else {
						$this->Session->setFlash(__('The recipients couldn\'t be deleted.'), 'default', array(
							'class' => 'flash_failure'), 
							'RecipientDeleted');
					}
				}
			}
			$this->redirect($this->referer());
		}
	}
	
}

