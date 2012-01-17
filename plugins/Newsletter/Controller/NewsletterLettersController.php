<?php

App::uses('CakeEmail', 'Network/Email', 'AppController', 'Controller');

class NewsletterLettersController extends AppController {
	
	var $layout = 'overlay';
	
	public $name = 'newsletterLetters';	
	public $uses = array('Newsletter.NewsletterLetter','Newsletter.NewsletterRecipient');
	
	public $paginate = array(
			'NewsletterLetter' => array(
				'limit' => 5, 
				'order' => array(
					'NewsletterLetter.date' => 'desc',
					'NewsletterLetter.id' => 'desc')));
	
	public function index($contentID){
		$newsletters = $this->paginate('NewsletterLetter');
		$this->set('newsletters', $newsletters);
		$this->set('contentID', $contentID);
	}
	
	public function edit($contentID, $id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$newsletter = $newsletter['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
		$this->set('contentID', $contentID);
	}
	
	public function save($contentID, $id){
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
			$newsletter = $this->NewsletterLetter->findById($id);
			$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			$newsletter['NewsletterLetter']['content'] = $newsletter2['contentEdit'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$this->NewsletterLetter->set($newsletter);
			if($newsletter = $this->NewsletterLetter->save()){
				$this->Session->setFlash('The newsletter was saved successfully.', 'default', array(
													'class' => 'flash_success'), 
													'NewsletterSaved');
			} else {
				$this->Session->setFlash('The newsletter couldn\'t be saved.', 'default', array(
																	'class' => 'flash_failure'), 
																	'NewsletterSaved');
			}
			$this->redirect(array(
				'action' => 'edit', $contentID, $newsletter['NewsletterLetter']['id']));
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
			$this->NewsletterLetter->set($newsletter);
			if($newsletter = $this->NewsletterLetter->save()){
				$this->Session->setFlash('The newsletter was saved successfully.', 'default', array(
										'class' => 'flash_success'), 
										'NewsletterSaved');
			} else {
				$this->Session->setFlash('The newsletter couldn\'t be saved.', 'default', array(
														'class' => 'flash_failure'), 
														'NewsletterSaved');
			}
			$this->redirect(array(
					'action' => 'edit', $contentID, $newsletter['NewsletterLetter']['id']));
		}
	}
	
	public function create($contentID){
		$newsletter = array(
						'subject' => NULL,
						'content' => NULL,
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
			$this->Session->setFlash('The newsletter has been deleted', 'default', array(
										'class' => 'flash_success'), 
										'NewsletterDeleted');
		} else {
			$this->Session->setFlash('The newsletter couldn\'t be deleted', 'default', array(
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
		$server = env('SERVER_NAME');
		$port = env('SERVER_PORT');
		
		if($server == 'localhost') {
			$server = $server.'.de';
		}
		echo $server;
		foreach ($recipients as $recipient){
			$email = new CakeEmail();
			$email->emailFormat('html')
			->template('Newsletter.newsletter', 'Newsletter.newsletter')
			->subject($newsletter['NewsletterLetter']['subject'])
			->to($recipient['NewsletterRecipient']['email'])
			->from('noreply@'.$server, 'DualonCMS')
			->viewVars(array(
				'text' => $newsletter['NewsletterLetter']['content']))
			->send();
		} //foreach
		$newsletter['NewsletterLetter']['draft'] = 0;
		$this->NewsletterLetter->set($newsletter);
		$this->NewsletterLetter->save();
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
						$this->Session->setFlash('The selected newsletters have been deleted', 'default', array(
										'class' => 'flash_success'), 
										'NewsletterDeleted');
					} else {
						$this->Session->setFlash('The selected newsletters couldn\'t be deleted', 'default', array(
																	'class' => 'flash_failure'), 
																			'NewsletterDeleted');
					}
				}
			}
		}
		$this->redirect($this->referer());
	}
	
}

