<?php
App::uses('CakeEmail', 'Network/Email');
class NewsletterLettersController extends AppController {
	var $layout = 'overlay';
	public $helpers = array('Fck');
	
	public $uses = array('Newsletter.NewsletterLetter');
	
	public $paginate = array(
			'NewsletterLetter' => array(
				'limit' => 5, 
				'order' => array(
					'NewsletterLetter.date' => 'desc')));
	
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
			$link = '/NewsletterLetters/edit'.$newsletter['NewsletterLetter']['id'];
			$this->redirect($this->referer($newsletter['NewsletterLetter']['id']));
			// hier noch save aus create auf editor mit entsprechendem Newsletter implementieren
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
// 		$newsletter = $newsletterToPreview['NewsletterLetter'];
		$this->set('newsletter', $newsletter);
		$this->layout = 'overlay';
	}
	
	public function delete($id){
		$this->NewsletterLetter->delete($id);
		$this->redirect($this->referer());
	}
	
	public function send($id){
		$newsletter = $this->NewsletterLetter->findById($id);
		$email = new CakeEmail();
		$email->emailFormat('html')
		->template('Newsletter.newsletter', 'email')
		->subject($newsletter['NewsletterLetter']['subject'])
		->to('marcuslieberenz@googlemail.com')
		->from('noreply@DualonCMS.de', 'DualonCMS')
		->viewVars(array('text' => $newsletter['NewsletterLetter']['content']
		))
		->send();
		$this->redirect($this->referer());
	}
	
}

