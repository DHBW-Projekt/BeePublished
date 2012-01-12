<?php
App::uses('CakeEmail', 'Network/Email');
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
	
	public function index(){
		$newsletters = $this->paginate('NewsletterLetter');
		$this->set('newsletters', $newsletters);
	}
	
	public function edit($id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$newsletter = $newsletter['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
	}
	
	public function save($id){
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
			if (!($id == 'new')){
				$newsletter = $this->NewsletterLetter->findById($id);
			} else {
				$newsletter = array();
			};
			$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
			$newsletter['NewsletterLetter']['content'] = $newsletter2['content'];
			$newsletter['NewsletterLetter']['draft'] = 1;
			$date = date('Y-m-d', time());
			$newsletter['NewsletterLetter']['date'] = $date;
			$this->NewsletterLetter->set($newsletter);
			$newsletter = $this->NewsletterLetter->save();
			$this->redirect(array(
				'action' => 'edit', $newsletter['NewsletterLetter']['id']));
		}
	}
	
	public function create(){
		$newsletter = array(
						'subject' => NULL,
						'content' => NULL,
						'id' => 'new');
		$this->set('newsletter', $newsletter);
// 		$this->layout = 'overlay';
		$this->render('/NewsletterLetters/edit');
	}
	
	public function preview($id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$this->set('newsletter', $newsletter);
		$this->layout = 'overlay';
	}
	
	public function delete($id){
		$this->NewsletterLetter->delete($id);
		$this->redirect($this->referer());
	}
	
	public function send($id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$recipients = $this->NewsletterRecipient->find('all', array(
			'fields' => array(
				'NewsletterRecipient.email'),
			'conditions' => array(
				'active' => 1)));
		foreach ($recipients as $recipient){
			$email = new CakeEmail();
			$email->emailFormat('html')
			->template('Newsletter.newsletter', 'email')
			->subject($newsletter['NewsletterLetter']['subject'])
			->to($recipient['NewsletterRecipient']['email'])
			->from('marcuslieberenz@googlemail.com', 'DualonCMS')
			->viewVars(array(
				'text' => $newsletter['NewsletterLetter']['content']))
			->send();
		} //foreach
		$this->redirect($this->referer());
	}
	
}

