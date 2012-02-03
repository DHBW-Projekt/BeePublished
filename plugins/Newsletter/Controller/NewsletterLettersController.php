<?php

App::uses('CakeEmail', 'Network/Email', 'AppController', 'Controller');

class NewsletterLettersController extends NewsletterAppController {
	
	var $layout = 'overlay';
	
	public $name = 'NewsletterLetters';	
	public $uses = array(
		'Newsletter.NewsletterLetter',
		'Newsletter.NewsletterRecipient',
		'Newsletter.EmailTemplate', 
		'Newsletter.EmailTemplateHeader');
	var $components = array('BeeEmail');
	
	public function index($contentID, $pluginId){
		$newsletters = $this->NewsletterLetter->find('all', array(
			'order' => array(
		 		'NewsletterLetter.date' => 'desc',
		 		'NewsletterLetter.id' => 'desc')));
		$this->set('newsletters', $newsletters);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function edit($contentID, $pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'EditNewsletter', true);
		$newsletter = $this->NewsletterLetter->findById($id);
		$newsletter = $newsletter['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function saveOrPreview($contentID, $pluginId, $id){
		if (isset($this->params['data']['save'])){
			$this->save($contentID, $pluginId, $id);
		} else {
			// save newsletter to show it in preview
			if ($this->request->is('post')){
				$newsletter2 = $this->request->data['NewsletterLetter'];
				$newsletter = $this->NewsletterLetter->findById($id);
				if ($newsletter2['subject'] != ''){
					$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
				};
				$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
				$newsletter['NewsletterLetter']['draft'] = 1;
				$date = date('Y-m-d', time());
				$newsletter['NewsletterLetter']['date'] = $date;
				$content = $newsletter['NewsletterLetter']['content'];
				$id = $newsletter['NewsletterLetter']['id'];
				$this->NewsletterLetter->set($newsletter);
				$newsletter = $this->NewsletterLetter->save();
			}
			// open preview:
			$this->redirect('/plugin/Newsletter/NewsletterLetters/preview/'.$contentID.'/'.$pluginId.'/'.$id);
		};
		$this->redirect($this->referer());
	}
	
	public function sendOrEdit($contentID, $pluginId, $id){
		if (isset($this->params['data']['send'])){
			$this->send($contentID, $pluginId, $id);
		} else {
			$this->redirect('/plugin/Newsletter/NewsletterLetters/edit/'.$contentID.'/'.$pluginId.'/'.$id);
		};
		$this->redirect($this->referer());
	}
	
	public function save($contentID, $pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'EditNewsletter', true);
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
			$newsletter = $this->NewsletterLetter->findById($id);
			if ($newsletter2['subject'] != ''){
				$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			};
			$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$content = $newsletter['NewsletterLetter']['content'];
			$id = $newsletter['NewsletterLetter']['id'];
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
			$this->redirect(array(
				'action' => 'edit', $contentID, $pluginId, $id));
		}
	}
	
	public function saveNew($contentID, $pluginId){
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
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
	
	public function create($contentID, $pluginId, $content){
		$pluginId = $this->getPluginId();
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($content == 'new'){
			$content = NULL;
		};
		$newsletter = array(
			'subject' => NULL,
			'content' => $content,
			'id' => 'new');
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function preview($contentID, $pluginId, $id){
		$pluginId = $this->getPluginId();
		$this->PermissionValidation->actionAllowed($pluginId, 'PreviewNewsletter', true);
		$newsletter = $this->NewsletterLetter->findById($id);
		$this->set('newsletter', $newsletter);
		$this->layout = 'overlay';
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function delete($contentID, $pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
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
	
	public function send($contentID, $pluginId, $id){
		$this->PermissionValidation->actionAllowed($pluginId, 'SendNewsletter', true);
		$newsletter = $this->NewsletterLetter->findById($id);
		$recipients = $this->NewsletterRecipient->find('all', array(
			'fields' => array(
				'NewsletterRecipient.email'),
			'conditions' => array(
				'active' => 1)));
		foreach ($recipients as $recipient){
			debug($recipient);
			$this->BeeEmail->sendHtmlEmail(
				$recipient['NewsletterRecipient']['email'],
				$newsletter['NewsletterLetter']['subject'],
				$newsletter['NewsletterLetter']['content']);
		} //foreach
		$newsletter['NewsletterLetter']['draft'] = 0;
		$this->NewsletterLetter->set($newsletter);
		$this->NewsletterLetter->save();
		$this->Session->setFlash(__d('newsletter','The newsletter has been sent successful.'), 'default', array(
										'class' => 'flash_success'), 
										'NewsletterSent');
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentID, $pluginId){
		$this->PermissionValidation->actionAllowed($pluginId, 'CreateNewsletter', true);
		if ($this->request->is('post')){
			$newsletters = $this->NewsletterLetter->find('all', array(
				'order' => array(
					'NewsletterLetter.date' => 'desc',
					'NewsletterLetter.id' => 'desc'),
				'conditions' => array(
					'NewsletterLetter.draft' => '1')));
			if (isSet($this->data['selectNewsletters'])){
				$selectedNewsletters = $this->data['selectNewsletters'];
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

