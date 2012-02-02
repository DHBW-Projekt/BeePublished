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

class SubscriptionController extends NewsletterAppController {
	
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'User', 'Newsletter.NewsletterLetter', 'MenuEntry');
	public $components = array('Menu');
 	

	function beforeRender(){
		parent::beforeRender();
		
		$pluginId = $this->getPluginId();
		$this->set('pluginId', $pluginId);
	}
	
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
 	
 	public function guestUnSubscribe(){
//  		echo 'test';
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
 						$this->Session->setFlash(__d('newsletter','The recipient was added successfully.'), 'default', array(
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
 		// get back to calling page
 		$this->redirect($this->referer());
 	}
 	
 	public function userUnSubscribe(){
 		$pluginId = $this->getPluginId();
 		$this->PermissionValidation->actionAllowed($pluginId, 'UnSubscribeUser', true);
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
 					$this->Session->setFlash(__d('newsletter','You have subscribed successfully.'), 'default', array(
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
 	
 	public function unSubscribePerMail($email){
 		$this->set('email', $email);
 		$this->set('menu', $this->Menu->buildMenu($this, NULL));
 		$this->set('adminMode', false);
 		$this->set('systemPage', true);
 	}
 	
 	public function unsubscribe(){
 		if ($this->request->is('post')){
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// inactivate recipient
 					$recipient['NewsletterRecipient']['active'] = 0;
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
 	
 	private function add(){
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
 	
}