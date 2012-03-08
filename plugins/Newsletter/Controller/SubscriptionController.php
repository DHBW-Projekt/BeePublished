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

App::uses('CakeEmail', 'Network/Email');
Configure::write('Config.language', 'ger');

/**
*
* This Controller implements the logic for the newsletter plugin standard view
* @author marcuslieberenz
*
*/
class SubscriptionController extends NewsletterAppController {
	
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'User', 'Newsletter.NewsletterLetter', 'MenuEntry');
	public $components = array('Menu','BeeEmail');
 	

	function beforeRender(){
		parent::beforeRender();
		$pluginId = $this->getPluginId();
		$this->set('pluginId', $pluginId);
	}
	
	function beforeFilter(){
		$this->Auth->allow('guestUnSubscribe');
		$this->Auth->allow('activateRecipient');
		$this->Auth->allow('subscribePerMail');
		$this->Auth->allow('unsubscribe');
		$this->Auth->allow('subscribe');
		parent::beforeFilter();
	}
	
	// get and set data that is necessary for the admin overlay
 	public function admin($contentID){
 		$pluginId = $this->getPluginId();
 		$this->PermissionValidation->actionAllowed($pluginId, 'OpenNewsletterOverlay', true);
 		$newsletters = $this->NewsletterLetter->find('all', array(
 			'order' => array(
 									'NewsletterLetter.date' => 'desc',
 									'NewsletterLetter.id' => 'desc')));
 		$this->set('newsletters', $newsletters);
 		$this->layout = 'overlay';
 		$this->set('pluginId', $pluginId);
 		$this->set('contentID', $contentID);
		$this->redirect(array(
			'plugin' => 'Newsletter', 
			'controller' => 'NewsletterLetters', 
			'action' => 'index', $contentID, $pluginId));
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
 	
 	// unSubscribe as guest
 	public function guestUnSubscribe(){
 		if ($this->request->is('post')){
 			// check if recipient exists
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
 					$this->sendInfoMail($recipient);
 					$action = 'delete';
 				} else {
 					// else activate recipient
 					$this->sendConfirmationMail($recipient);
 					$action = 'add';
 				}
 				// save recipient and show flash
 				$this->NewsletterRecipient->set($recipient);
 				if($this->NewsletterRecipient->save()) {
 					if ($action == 'add'){
 						$this->Session->setFlash(__d('newsletter','The recipient was added successfully. A confirmation link was sent per e-mail.'), 'default', array(
 										'class' => 'flash_success'), 
 										'NewsletterRecipient');
 					} else {
 						$this->Session->setFlash(__d('newsletter','The recipient was removed successfully.'), 'default', array(
 									'class' => 'flash_success'), 
 									'NewsletterRecipient');
 					}
 				} else {
 					$this->Session->setFlash(__d('newsletter','The recipient was not added.'), 'default', array(
 								'class' => 'flash_failure'), 
 								'NewsletterRecipient');
 					$this->_persistValidation('NewsletterRecipient');
 				}
 			} else {
 				// if recipient doesn't exist, create a new one
 				$this->add();
 			}
 		}
//  		get back to calling page
 		$this->redirect($this->referer());
 	}
 	
 	// unSubscribe as user
 	public function userUnSubscribe(){
 		$pluginId = $this->getPluginId();
 		// check if user is allowed to unSubscribe
 		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeUser', true);
 		if ($this->request->is('post')){
 			$user = $this->Auth->user();
 			// check if user is already recipient (active or inactive)
 			if($recipient = $this->NewsletterRecipient->findByUser_id($user['id'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
 					$this->sendInfoMail($recipient);
 					$action = 'delete';
 				} else {
 					// else activate recipient
					$this->sendConfirmationMail($recipient);
 					$action = 'add';
 				}
 			} else {
 				$token = sha1($user['email'] . rand(0, 100));
 				// if recipient doesn't exist, create a new one
 				$recipient = array(
 											'NewsletterRecipient' => array(
 												'email' => $user['email'],
 												'user_id' => $user['id'],
 												'active' => '0',
 												'confirmation_token' => $token));
 				$this->sendConfirmationMail($recipient);
 				$action = 'add';
 			}
 			// update or save recipient and show flash
 			$this->NewsletterRecipient->set($recipient);
 			if($this->NewsletterRecipient->save()) {
 				if ($action == 'add'){
 					$this->Session->setFlash(__d('newsletter','You have subscribed successfully. A confirmation link was sent per e-mail.'), 'default', array(
 										'class' => 'flash_success'), 
 										'NewsletterRecipient');
 				} else {
 					$this->Session->setFlash(__d('newsletter', 'You have unsubscribed successfully.'), 'default', array(
 									'class' => 'flash_success'), 
 									'NewsletterRecipient');
 				}
 			} else {
 				$this->Session->setFlash(__d('newsletter', 'The subscription was not successful.'), 'default', array(
 								'class' => 'flash_failure'), 
 								'NewsletterRecipient');
 				$this->_persistValidation('NewsletterRecipient');
 			}
 			$this->redirect($this->referer());
 		}
 	}
 	
 	// set data for subscription per mail
 	public function subscribePerMail($email){
 		$this->set('email', $email);
 		$this->set('menu', $this->Menu->buildMenu($this, NULL));
 		$this->set('adminMode', false);
 		$this->set('systemPage', true);
 	}
 	
 	// set data for unsubscription per mail
 	public function unSubscribePerMail($email){
 		$this->set('email', $email);
 		$this->set('menu', $this->Menu->buildMenu($this, NULL));
 		$this->set('adminMode', false);
 		$this->set('systemPage', true);
 	}
 	
 	//subscribe per mail
 	public function subscribe(){
 		if ($this->request->is('post')){
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 0){
 					// inactivate recipient per mail
 					$this->sendConfirmationMail($recipient);
 					$action = 'add';
 					$this->NewsletterRecipient->set($recipient);
 					if($this->NewsletterRecipient->save()) {
 						$this->Session->setFlash(__d('newsletter','You have subscribed successfully. A confirmation link was sent per e-mail.'), 'default', array(
 		 					 									'class' => 'flash_success'), 
 		 					 									'subscribePerMail');
 					} else {
 						$this->Session->setFlash(__d('newsletter','You couldn\'t be subscribed.'), 'default', array(
 		 						 					 			'class' => 'flash_failure'), 
 		 						 					 			'subscribePerMail');
 					}
 				}else {
 					$this->Session->setFlash(__d('newsletter','You haven\'t unsubscribed'), 'default', array(
 		 					 				 						 					 			'class' => 'flash_failure'), 
 		 					 				 						 					 			'subscribePerMail');
 				}
 			} else {
 				$this->Session->setFlash(__d('newsletter','You haven\'t unsubscribed'), 'default', array(
 		 				 				 						 					 			'class' => 'flash_failure'), 
 		 				 				 						 					 			'subscribePerMail');
 			}
 		}
 		$this->redirect($this->referer());
 		
 	}
 	
 	// unsubscribe per mail
 	public function unsubscribe(){
 		if ($this->request->is('post')){
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
 					$this->sendInfoMail($recipient);
 					$action = 'delete';
 					$this->NewsletterRecipient->set($recipient);
 					if($this->NewsletterRecipient->save()) {
 						$this->Session->setFlash(__d('newsletter','You have unsubscribed successfully.'), 'default', array(
 					 									'class' => 'flash_success'), 
 					 									'unsubscribePerMail');
 					} else {
 						$this->Session->setFlash(__d('newsletter','You couldn\'t be unsubscribed.'), 'default', array(
 						 					 			'class' => 'flash_failure'), 
 						 					 			'unsubscribePerMail');
 					}
 				}else {
 					$this->Session->setFlash(__d('newsletter','You haven\'t subscribed'), 'default', array(
 					 				 						 					 			'class' => 'flash_failure'), 
 					 				 						 					 			'unsubscribePerMail');
 				}
 			} else {
 				$this->Session->setFlash(__d('newsletter','You haven\'t subscribed'), 'default', array(
 				 				 						 					 			'class' => 'flash_failure'), 
 				 				 						 					 			'unsubscribePerMail');
 			}
 		}
 		$this->redirect($this->referer());
 	}
 	
 	// add new recipient
 	private function add(){
 		if ($this->request->is('post')){
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
 			$action = 'add';
 			// save recipient and show flash
 			$this->NewsletterRecipient->set($recipient);
 			if($this->NewsletterRecipient->save()) {
 				if ($action == 'add'){
 					$this->Session->setFlash(__d('newsletter','The recipient was added successfully. A confirmation link was sent per e-mail.'), 'default', array(
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
 	
}