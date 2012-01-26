<?php

class NewsletterRecipientsController extends NewsletterAppController {
	
	var $layout = 'overlay';
	
	public $uses = array('Newsletter.NewsletterRecipient', 'User');
		
	public function index($contentID, $pluginId){
		$recipients = $this->NewsletterRecipient->find('all', array(
			'order' => array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1))); 
		$this->set('recipients', $recipients);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function delete($pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
		$recipient = $this->NewsletterRecipient->findById($id);
		// delete = set recipient inactive
		$recipient['NewsletterRecipient']['active'] = NULL;
		// save updated recipient
		$this->NewsletterRecipient->set($recipient);
		if($this->NewsletterRecipient->save()){
			$this->Session->setFlash(__d('newsletter','The recipient was deleted successfully.'), 'default', array(
				'class' => 'flash_success'), 
				'RecipientDeleted');
		} else {
			$this->Session->setFlash(__d('newsletter','The recipient couldn\'t be deleted.'), 'default', array(
				'class' => 'flash_failure'), 
				'RecipientDeleted');
		}
		$this->redirect($this->referer());
	}
	
	public function add($pluginId){
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
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
					$this->Session->setFlash(__d('newsletter','The user was added successfully.'), 'default', array(
						'class' => 'flash_success'), 
						'NewsletterRecipient');
				} else {
					$this->Session->setFlash(__d('newsletter','The user was removed successfully.'), 'default', array(
						'class' => 'flash_success'), 
					'NewsletterRecipient');
				}
			} else {
				$this->Session->setFlash(__d('newsletter','The user was not added.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterRecipient');
				$this->_persistValidation('NewsletterRecipient');
			}
		}
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentID, $pluginId){
		$pluginId = $this->getPluginId();
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
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
						$this->Session->setFlash(__d('newsletter','The selected recipients have been deleted successfully.'), 'default', array(
							'class' => 'flash_success'), 
							'RecipientDeleted');
					} else {
						$this->Session->setFlash(__d('newsletter','The recipients couldn\'t be deleted.'), 'default', array(
							'class' => 'flash_failure'), 
							'RecipientDeleted');
					}
				}
			}
			$this->redirect($this->referer());
		}
	}
	
}

