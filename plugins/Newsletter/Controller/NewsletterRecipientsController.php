<?php

/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

/**
*
* This Controller implements all logic for adding or deleting recipients in the admin overlay
* @author marcuslieberenz
*
*/
class NewsletterRecipientsController extends NewsletterAppController {
	
	var $layout = 'overlay';
	
	public $uses = array('Newsletter.NewsletterRecipient', 'User');
	public $components = array('Menu','BeeEmail');
		
	// get and set data for index view
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
	
	// delete recipient
	public function delete($pluginId, $id){
		// check if user is allowed to delete recipients
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
		// get recipient
		$recipient = $this->NewsletterRecipient->findById($id);
		// delete = set recipient inactive
		$this->sendInfoMail($recipient);
		$recipient['NewsletterRecipient']['active'] = 0;
		// save updated recipient and show flash
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
	
	// add new recipient
	public function add($pluginId){
		// check if user is allowed to add recipients
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
		if ($this->request->is('post')){
			// get email from input field
			$email = $this->data['NewsletterRecipient']['email'];
			// check, if recipient already exists, but is inactive
			$recipient = $this->NewsletterRecipient->findByEmail($email);
			if (($recipient) && ($recipient['NewsletterRecipient']['active'] == 0)){
				// set active
				$this->sendConfirmationMail($recipient);
			} else {
				// create new recipient
				// check, if recipient is user
				$user = $this->User->findByEmail($email);
				$token = sha1($email . rand(0, 100));
				if(isset($user)){
					// recipient is user --> add user_id
					$recipient = array(
						'NewsletterRecipient' => array(
							'email' => $email,
							'user_id' => $user['User']['id'],
							'active' => '0',
							'confirmation_token' => $token));
					$this->sendConfirmationMail($recipient);
				} else {
					$recipient = array(
						'NewsletterRecipient' => array(
							'email' => $email,
							'user_id' => NULL,
							'active' => '0',
							'confirmation_token' => $token));
					$this->sendConfirmationMail($recipient);
				}
			}
			// $action is necessary to know if a user is added or deleted
			$action = 'add';
			// save recipient and show flash
			$this->NewsletterRecipient->set($recipient);
			if($this->NewsletterRecipient->save()) {
				if ($action == 'add'){
					$this->Session->setFlash(__d('newsletter','The recipient was added successfully. A confirmation link was sent per e-mail.'), 'default', array(
						'class' => 'flash_success'), 
						'NewsletterRecipient');
				};
			} else {
				$this->Session->setFlash(__d('newsletter','The recipient was not added.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterRecipient');
				$this->_persistValidation('NewsletterRecipient');
			}
		}
		$this->redirect($this->referer());
	}
	
	// delete selected recipients
	public function deleteSelected($contentID, $pluginId){
		// check if user is allowed to delete recipients
		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeOtherUsers', true);
		if ($this->request->is('post')){
			// get all recipients
			$recipients = $this->NewsletterRecipient->find('all', array(
			'order' => array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1)));
			if (isSet($this->data['selectRecipients'])){
				// get selected (checkboxes) recipient
				$selectedRecipients = $this->data['selectRecipients'];
				// delete each selected recipient
				foreach($recipients as $recipient){
					$id = $recipient['NewsletterRecipient']['id'];
					if ($selectedRecipients[$id] == 1){
						// delete = set recipient inactive
						$recipient['NewsletterRecipient']['active'] = 0;
						$this->sendInfoMail($recipient);
						// save updated recipient and show flash
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
			} else {
				$this->Session->setFlash(__d('newsletter','You haven\'t selected any recipient to delete.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterDeleted');
			}
			$this->redirect($this->referer());
		}
	}
	
	// activate recipient via mail
	public function activateRecipient($email = null, $token = null){
		$recipient = $this->NewsletterRecipient->findByEmail($email);
		$this->set('menu', $this->Menu->buildMenu($this, NULL));
		$this->set('adminMode', false);
		$this->set('systemPage', true);
		if (isset($recipient)){
			if ($recipient['NewsletterRecipient']['confirmation_token'] == $token){
				// set recipient active
				$recipient['NewsletterRecipient']['active'] = 1;
				$this->NewsletterRecipient->set($recipient);
				if ($this->NewsletterRecipient->save()){
					$this->Session->setFlash(__d('newsletter','Your subscription was successfull.'), 'default', array(
	 										'class' => 'flash_success'), 
	 										'activateRecipient');
				} else {
					$this->Session->setFlash(__d('newsletter','Your subscription wasn\'t successfull. Please contact the administrator of this homepage.'), 'default', array(
	 					 										'class' => 'flash_failure'), 
	 					 										'activateRecipient');
				};
			} else {
				$this->Session->setFlash(__d('newsletter','Your subscription wasn\'t successfull. Please contact the administrator of this homepage.'), 'default', array(
	 				 					 										'class' => 'flash_failure'), 
	 				 					 										'activateRecipient');
			}
		} else {
			$this->Session->setFlash(__d('newsletter','Your subscription wasn\'t successfull. Please contact the administrator of this homepage.'), 'default', array(
	 			 				 					 										'class' => 'flash_failure'), 
	 			 				 					 										'activateRecipient');
		}
	}
	
	// send confirmation mail before activating recipient
	public function sendConfirmationMail($recipient = null){
		// get server URL
		$url = "http://".env('SERVER_NAME');
		if (env('SERVER_PORT') != 80){
			$url = $url.":".env('SERVER_PORT');
		};
		$url = $url.$this->webroot."activatepermail/".$recipient['NewsletterRecipient']['email'].'/'.$recipient['NewsletterRecipient']['confirmation_token'];
		$subject = __d('newsletter', 'Please confirm your newsletter subscription');
		$content =
	 		"<br>"
		.__d('newsletter', 'Please confirm your subscription for our newsletter by clicking ')
		."<a href='"
		.$url
		."'>"
		.__d('newsletter', 'here')."."
		."</a>"
		."<br><br>";
		// send mail
		$this->BeeEmail->sendHtmlEmail(
		$recipient['NewsletterRecipient']['email'],
		$subject,
		$content);
	}
	
	// send mail with information that recipient has been unsubscribed
	public function sendInfoMail($recipient){
		$url = "http://".env('SERVER_NAME');
		if (env('SERVER_PORT') != 80){
			$url = $url.":".env('SERVER_PORT');
		};
		$url = $url.$this->webroot."subscribepermail/".$recipient['NewsletterRecipient']['email'];
		$subject = __d('newsletter', 'You have successfully been unsubscribed from our newsletter');
		$content =
	 		 		"<br>"
		.__d('newsletter', 'You have successfully been unsubscribed from our newsletter.')
		.'<br>'
		.__d('newsletter', 'If you want to subcribe to our newsletter again, click ')
		."<a href='"
		.$url
		."'>"
		.__d('newsletter', 'here')."."
		."</a>"
		."<br><br>";
		// send mail
		$this->BeeEmail->sendHtmlEmail(
		$recipient['NewsletterRecipient']['email'],
		$subject,
		$content);
	}
	
}



