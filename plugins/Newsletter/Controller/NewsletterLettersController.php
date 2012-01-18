<?php

App::uses('CakeEmail', 'Network/Email', 'AppController', 'Controller');

class NewsletterLettersController extends AppController {
	
	var $layout = 'overlay';
	
	public $name = 'newsletterLetters';	
	public $uses = array('Newsletter.NewsletterLetter','Newsletter.NewsletterRecipient','Newsletter.EmailTemplate', 'Newsletter.EmailTemplateHeader');
	var $components = array('BeeEmail');
	
// 	public $paginate = array(
// 			'NewsletterLetter' => array(
// 				'limit' => 10, 
// 				'order' => array(
// 					'NewsletterLetter.date' => 'desc',
// 					'NewsletterLetter.id' => 'desc')));
	
	public function index($contentID){
// 		$newsletters = $this->paginate('NewsletterLetter');
		$newsletters = $this->NewsletterLetter->find('all', array(
			'order' => array(
		 		'NewsletterLetter.date' => 'desc',
		 		'NewsletterLetter.id' => 'desc')));
		$this->set('newsletters', $newsletters);
		$this->set('contentID', $contentID);
	}
	
	public function edit($contentID, $id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$newsletter = $newsletter['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
	}
	
	public function saveOrPreview($contentID, $id){
		if (isset($this->params['data']['save'])){
			$this->save($contentID, $id);
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
			$this->redirect('/plugin/Newsletter/NewsletterLetters/preview/'.$contentID.'/'.$id);
		};
		$this->redirect($this->referer());
	}
	
	public function sendOrEdit($contentID, $id){
		if (isset($this->params['data']['send'])){
			$this->send($contentID, $id);
		} else {
			$this->redirect('/plugin/Newsletter/NewsletterLetters/edit/'.$contentID.'/'.$id);
		};
		$this->redirect($this->referer());
	}
	
	public function save($contentID, $id){
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
				$this->Session->setFlash(__('The newsletter was saved successfully.'), 'default', array(
					'class' => 'flash_success'), 
					'NewsletterSaved');
			} else {
				$this->Session->setFlash(__('The newsletter couldn\'t be saved.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterSaved');
				$this->_persistValidation('NewsletterLetter');
			}
			$this->redirect(array(
				'action' => 'edit', $contentID, $id));
		}
	}
	
	public function saveNew($contentID){
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
			$newsletter = array();
			$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$content = $newsletter['NewsletterLetter']['content'];
			$this->NewsletterLetter->set($newsletter);
			if($newsletter = $this->NewsletterLetter->save()){
				$this->Session->setFlash(__('The newsletter was saved successfully.'), 'default', array(
					'class' => 'flash_success'), 
					'NewsletterSaved');
				$this->redirect(array(
					'action' => 'edit', $contentID, $newsletter['NewsletterLetter']['id']));
			} else {
				$this->Session->setFlash(__('The newsletter couldn\'t be saved.'), 'default', array(
					'class' => 'flash_failure'), 
					'NewsletterSaved');
				$this->_persistValidation('NewsletterLetter');
				$this->redirect(array(
								'action' => 'create', $contentID, $content));
			}
			
		}
	}
	
	public function create($contentID, $content){
		if ($content == 'new'){
			$content = NULL;
		};
		$newsletter = array(
			'subject' => NULL,
			'content' => $content,
			'id' => 'new');
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
	}
	
	public function preview($contentID, $id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$this->set('newsletter', $newsletter);
		$this->layout = 'overlay';
		$this->set('contentID', $contentID);
	}
	
	public function delete($contentID, $id){
		if($this->NewsletterLetter->delete($id)){
			$this->Session->setFlash(__('The newsletter has been deleted'), 'default', array(
				'class' => 'flash_success'), 
				'NewsletterDeleted');
		} else {
			$this->Session->setFlash(__('The newsletter couldn\'t be deleted'), 'default', array(
				'class' => 'flash_failure'), 
				'NewsletterDeleted');
		}
		$this->redirect($this->referer());
	}
	
	public function send($contentID, $id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$recipients = $this->NewsletterRecipient->find('all', array(
			'fields' => array(
				'NewsletterRecipient.email'),
			'conditions' => array(
				'active' => 1)));
//		$server = env('SERVER_NAME');
//		$port = env('SERVER_PORT');
//		
//		if($server == 'localhost') {
//			$server = $server.'.de';
//		}
		foreach ($recipients as $recipient){
//			$email = new CakeEmail();
//			$email->emailFormat('html')
//			->template('Newsletter.newsletter', 'Newsletter.newsletter')
//			->subject($newsletter['NewsletterLetter']['subject'])
//			->to($recipient['NewsletterRecipient']['email'])
//			->from('noreply@'.$server, 'DualonCMS')
//			->viewVars(array(
//				'text' => $newsletter['NewsletterLetter']['content']))
//			->send();
			$this->BeeEmail->sendTemplatedHtmlEmail(
				$recipient['NewsletterRecipient']['email'],
				$newsletter['NewsletterLetter']['subject'],
				$newsletter['NewsletterLetter']['content']);
		} //foreach
		$newsletter['NewsletterLetter']['draft'] = 0;
		$this->NewsletterLetter->set($newsletter);
		$this->NewsletterLetter->save();
		$this->Session->setFlash(__('The newsletter has been sent successful.'), 'default', array(
										'class' => 'flash_success'), 
										'NewsletterSent');
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentID){
		if ($this->request->is('post')){
			$newsletters = $this->NewsletterLetter->find('all', array(
				'order' => array(
					'NewsletterLetter.date' => 'desc',
					'NewsletterLetter.id' => 'desc'),
				'conditions' => array(
					'NewsletterLetter.draft' => '1')));
			$selectedNewsletters = $this->data['selectNewsletters'];
			foreach($newsletters as $newsletter){
				$id = $newsletter['NewsletterLetter']['id'];
				if ($selectedNewsletters[$id] == 1){
					if($this->NewsletterLetter->delete($id)){
						$this->Session->setFlash(__('The selected newsletters have been deleted'), 'default', array(
							'class' => 'flash_success'), 
							'NewsletterDeleted');
					} else {
						$this->Session->setFlash(__('The selected newsletters couldn\'t be deleted'), 'default', array(
							'class' => 'flash_failure'), 
						'NewsletterDeleted');
					}
				}
			}
		}
		$this->redirect($this->referer());
	}
	
}

