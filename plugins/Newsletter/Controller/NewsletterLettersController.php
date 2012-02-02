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

App::uses('CakeEmail', 'Network/Email', 'AppController', 'Controller');

/**
 * 
 * This Controller implements all logic for creating, editing, deleting or sending newsletter in the admin overlay
 * @author marcuslieberenz
 *
 */
class NewsletterLettersController extends NewsletterAppController {
	
	var $layout = 'overlay';
	
	public $uses = array(
		'Newsletter.NewsletterLetter',
		'Newsletter.NewsletterRecipient',
		'Newsletter.EmailTemplate', 
		'Newsletter.EmailTemplateHeader');
	var $components = array('BeeEmail');
	

	// Load and set data for index view
	public function index($contentID, $pluginId){
		$newsletters = $this->NewsletterLetter->find('all', array(
			'order' => array(
		 		'NewsletterLetter.date' => 'desc',
		 		'NewsletterLetter.id' => 'desc')));
		$this->set('newsletters', $newsletters);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	// Load and set data for edit view
	public function edit($contentID, $pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'EditNewsletter', true);
		$newsletter = $this->NewsletterLetter->findById($id);
		$newsletter = $newsletter['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	// Check if button for saving or preview is clicked
	public function saveOrPreview($contentID, $pluginId, $id){
		if (isset($this->params['data']['save'])){
			// save button is clicked
			$this->save($contentID, $pluginId, $id);
		} else {
			// preview button is clicked
			// save newsletter to show it in preview
			if ($this->request->is('post')){
				// get new version of newsletter
				$newsletter2 = $this->request->data['NewsletterLetter'];
				// get old version of newsletter
				$newsletter = $this->NewsletterLetter->findById($id);
				// check if subject is set, otherwise set old subject again
				if ($newsletter2['subject'] != ''){
					$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
				};
				// set content, draft status, id and date
				$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
				$newsletter['NewsletterLetter']['draft'] = 1;
				$date = date('Y-m-d', time());
				$newsletter['NewsletterLetter']['date'] = $date;
				$content = $newsletter['NewsletterLetter']['content'];
				$id = $newsletter['NewsletterLetter']['id'];
				// save newsletter
				$this->NewsletterLetter->set($newsletter);
				$newsletter = $this->NewsletterLetter->save();
			}
			// open preview for current newsletter
			$this->redirect('/plugin/Newsletter/NewsletterLetters/preview/'.$contentID.'/'.$pluginId.'/'.$id);
		};
		// open editor again
		$this->redirect($this->referer());
	}
	
	// check if send or edit button is clicked
	public function sendOrEdit($contentID, $pluginId, $id){
		if (isset($this->params['data']['send'])){
			//send button is clicked
			$this->send($contentID, $pluginId, $id);
		} else {
			// edit button is clicked
			$this->redirect('/plugin/Newsletter/NewsletterLetters/edit/'.$contentID.'/'.$pluginId.'/'.$id);
		};
		$this->redirect($this->referer());
	}
	
	// save current newsletter
	public function save($contentID, $pluginId, $id){
		// check if current user is allowed to edit (and save) newsletters, otherwise cancel action
		$this->PermissionValidation->actionAllowed($pluginId, 'EditNewsletter', true);
		if ($this->request->is('post')){
			// get new version of newsletter
			$newsletter2 = $this->request->data['NewsletterLetter'];
			// get old version of newsletter
			$newsletter = $this->NewsletterLetter->findById($id);
			// check if subject is set, otherwise set old subject again
			if ($newsletter2['subject'] != ''){
				$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			};
			// set content, draft status, id and date
			$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$content = $newsletter['NewsletterLetter']['content'];
			$id = $newsletter['NewsletterLetter']['id'];
			// save newsletter and show flash if success or failure
			$this->NewsletterLetter->set($newsletter);
			if($newsletter = $this->NewsletterLetter->save()){
				$this->Session->setFlash(__d('newsletter','The newsletter was saved successfully.'), 'default', array(
					'class' => 'flash_success'), 
					'NewsletterSaved');
			} else {
				$this->Session->setFlash(__d('newsletter','The newsletter couldn\'t be saved.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterSaved');
				$this->_persistValidation('NewsletterLetter');
			}
			// redirect to edit view
			$this->redirect(array(
				'action' => 'edit', $contentID, $pluginId, $id));
		}
	}
	
	// save new created newsletter
	public function saveNew($contentID, $pluginId){
		// check if user is allowed to create newsletters
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($this->request->is('post')){
			// get newsletter data
			$newsletter2 = $this->request->data['NewsletterLetter'];
			// "create" new newsletter an set subject, content and date
			$newsletter = array();
			$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$content = $newsletter['NewsletterLetter']['content'];
			if ($content == NULL){
				$content = ' ';
			};
			// save newsletter and show flash if success or failure
			$this->NewsletterLetter->set($newsletter);
			if($newsletter = $this->NewsletterLetter->save()){
				$this->Session->setFlash(__d('newsletter','The newsletter was saved successfully.'), 'default', array(
					'class' => 'flash_success'), 
					'NewsletterSaved');
				$this->redirect(array(
					'action' => 'edit', $contentID, $pluginId, $newsletter['NewsletterLetter']['id']));
			} else {
				$this->Session->setFlash(__d('newsletter','The newsletter couldn\'t be saved.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterSaved');
				$this->_persistValidation('NewsletterLetter');
				$this->redirect(array(
								'action' => 'create', $contentID, $pluginId, $content));
			}
			
		}
	}
	
	// create Newsletter
	public function create($contentID, $pluginId, $content){
		// check if user is allowed to create newsletters
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($content == 'new'){
			$content = NULL;
		};
		// "create" new newsletter
		$newsletter = array(
			'subject' => NULL,
			'content' => $content,
			'id' => 'new');
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	// show newsletter preview
	public function preview($contentID, $pluginId, $id){
		// check if user is allowed to show newsletter preview
		$this->PermissionValidation->actionAllowed($pluginId, 'PreviewNewsletter', true);
		// get and newsletter data
		$newsletter = $this->NewsletterLetter->findById($id);
		$this->set('newsletter', $newsletter);
		$this->layout = 'overlay';
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	// delete newsletter 
	public function delete($contentID, $pluginId, $id){
		// check if user is allowed to create (and delete) newsletters
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		// delete and show flash if success or failure
		if($this->NewsletterLetter->delete($id)){
			$this->Session->setFlash(__d('newsletter','The newsletter has been deleted'), 'default', array(
				'class' => 'flash_success'), 
				'NewsletterDeleted');
		} else {
			$this->Session->setFlash(__d('newsletter','The newsletter couldn\'t be deleted'), 'default', array(
				'class' => 'flash_failure'), 
				'NewsletterDeleted');
		}
		$this->redirect($this->referer());
	}
	
	// send newsletter
	public function send($contentID, $pluginId, $id){
		// check if user is allowed to send newsletters
		$this->PermissionValidation->actionAllowed($pluginId, 'SendNewsletter', true);
		// get newsletter and recipients data
		$newsletter = $this->NewsletterLetter->findById($id);
		$recipients = $this->NewsletterRecipient->find('all', array(
			'fields' => array(
				'NewsletterRecipient.email'),
			'conditions' => array(
				'active' => 1)));
		// send newsletter to each recipients
		foreach ($recipients as $recipient){
			// add line with unsubscription link to email-content
			$content = $newsletter['NewsletterLetter']['content'];
			$content = $content
					."<br><br>"
					."<span style='font-size: 9px'>"
					.__d('newsletter', 'If you want to unsubscribe from our newsletter, click ')
					."<a href='"
					.env('SERVER_NAME')
					."/unsubscribepermail/"
					.$recipient['NewsletterRecipient']['email']
					.__d('newsletter', 'here')
					."</a>."
					."</span>";
			// send mail
			$this->BeeEmail->sendHtmlEmail(
				$recipient['NewsletterRecipient']['email'],
				$newsletter['NewsletterLetter']['subject'],
				$content);
		} //foreach
		// save newsletter with new status and flash if success or failure
		$newsletter['NewsletterLetter']['draft'] = 0;
		$this->NewsletterLetter->set($newsletter);
		$this->NewsletterLetter->save();
		$this->Session->setFlash(__d('newsletter','The newsletter has been sent successful.'), 'default', array(
										'class' => 'flash_success'), 
										'NewsletterSent');
		$this->redirect($this->referer());
	}
	
	// delete selected (checkboxes) newsletters
	public function deleteSelected($contentID, $pluginId){
		// check if user is allowed to create (and delete) newsletters
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($this->request->is('post')){
			// get all newsletters
			$newsletters = $this->NewsletterLetter->find('all', array(
				'order' => array(
					'NewsletterLetter.date' => 'desc',
					'NewsletterLetter.id' => 'desc'),
				'conditions' => array(
					'NewsletterLetter.draft' => '1')));
			// get selected Newsletters
			if (isSet($this->data['selectNewsletters'])){
				$selectedNewsletters = $this->data['selectNewsletters'];
				// delete each selected newsletter and show flash
				foreach($newsletters as $newsletter){
					$id = $newsletter['NewsletterLetter']['id'];
					if ($selectedNewsletters[$id] == 1){
						if($this->NewsletterLetter->delete($id)){
							$this->Session->setFlash(__d('newsletter','The selected newsletters have been deleted'), 'default', array(
								'class' => 'flash_success'), 
								'NewsletterDeleted');
						} else {
							$this->Session->setFlash(__d('newsletter','The selected newsletters couldn\'t be deleted'), 'default', array(
								'class' => 'flash_failure'), 
							'NewsletterDeleted');
						}
					}
				}
			} else {
				$this->Session->setFlash(__d('newsletter','You haven\'t selected any newsletter to delete.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterDeleted');
			}
		}
		$this->redirect($this->referer());
	}
	
}

