<?php
App::uses('CakeEmail', 'Network/Email');
class SubscriptionController extends AppController {
		
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'Newsletter.NewsletterLetter', 'Newsletter.EmailTemplate');
 	public $helpers = array('Fck');
 	
//  var $autoLayout = false;
// 	var $autoRender = false;
		
	public $paginate = array(
		'NewsletterLetter' => array(
			'limit' => 5, 
			'order' => array(
				'NewsletterLetter.date' => 'desc')),
		 'NewsletterRecipient' => array(
			'limit' => 10,
			'order'	=> array(
				'NewsletterRecipient.email' => 'asc'),
			'conditions' => array(
				'NewsletterRecipient.active' => 1)),
		'EmailTemplate' => array(
			'limit' => 10,
			'order' => array(
				'EmailTemplate.id' => 'asc'))
	);
			
	public function newsletteradmin(){
		$this->getAndSetData();
		$this->set('mode', '');
		$this->layout = 'overlay';
		$this->render('admin');
	}
	
	public function newsletterPreview($id){
		$newsletterToPreview = $this->NewsletterLetter->find('first', array(
			'conditions' => array(
				'NewsletterLetter.id' => $id)));
		$newsletterToPreview = $newsletterToPreview['NewsletterLetter'];
		$this->set(array(
			'newsletterToPreview' => $newsletterToPreview,
			'mode' => 'preview'));
		$this->getAndSetData();
		$this->layout = 'overlay';
		$this->render('admin');
	}
	
	public function editNewsletter($id){
		$newsletterToEdit = $this->NewsletterLetter->find('first', array(
			'conditions' => array(
				'NewsletterLetter.id' => $id)));
		$newsletterToEdit = $newsletterToEdit['NewsletterLetter'];
		$this->set(array(
			'newsletterToEdit' => $newsletterToEdit,
			'mode' => 'edit'));
		$this->getAndSetData();
		$this->layout = 'overlay';
		$this->render('admin');
	}
	
	public function createNewsletter(){
		$newsletterToEdit = array(
			'subject' => NULL,
			'content' => NULL,
			'id' => 'new');
		$this->set(array(
			'newsletterToEdit' => $newsletterToEdit,
			'mode' => 'edit'));
		$this->getAndSetData();
		$this->layout = 'overlay';
		$this->render('admin');
	}
	
	public function sendNewsletter($newsletter_id) {
		
		$email = new CakeEmail();
    	$email->emailFormat('html');
    	$email->template('user_activated', 'email');
    	
    	
    	$newsletter = $this->NewsletterLetter->findById($newsletter_id);
    	$email->subject($newsletter['NewsletterLetter']['subject']);
		$email->to('tobiashoehmann@googlemail.com');
		$email->from('noreply@DualonCMS.de', 'DualonCMS');
		$email->viewVars(array(
			'content' => $newsletter['NewsletterLetter']['content'],
        ));
		$email->send();
		$this->redirect('/plugin/Newsletter/Subscription/newsletteradmin/');
	}
	
	public function deleteNewsletter($id){
		$this->NewsletterLetter->delete($id);
		$this->redirect($this->referer());
	}
	
	public function saveNewsletter($newsletter_id){
		if ($this->request->is('post')){
			$newsletter2 = $this->request->data['NewsletterLetter'];
			if (!($newsletter_id == 'new')){
				$newsletter = $this->NewsletterLetter->findById($newsletter_id);
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
			$newsletter = $newsletter['NewsletterLetter'];
			
// 			debug($newsletter);
			$this->editNewsletter($newsletter['id']);
			
		}
// 		$this->redirect($this->referer());
	}
	
	private function getAndSetData(){
		$newsletters = $this->getNewsletters();
		$recipients = $this->getActiveRecipients();
		$this->set(array(
			'newsletters' => $newsletters,
			'recipients' => $recipients
		));
	}
	
	public function admin($contentID){
		$user = $this->Auth->user();
		$email = $user['email'];
		$recipient = $this->getRecipient($email);
		$isRecipient = $this->checkRecipientIsActive($recipient);
		print_r($isRecipient);
		$this->set('isRecipient', $isRecipient);	
		$this->layout = 'overlay';
		$this->getAndSetData();
	}
	
	private function getActiveRecipients(){
		$recipients = $this->paginate('NewsletterRecipient');
		return $recipients;
	}
	
	private function getNewsletters(){
		$newsletters = $this->paginate('NewsletterLetter');
		return $newsletters;
	}
	
	private function getRecipient($email){
		// returns recipient if existing
		$recipient = $this->NewsletterRecipient->find('first', array(
			'conditions' => array(
				'NewsletterRecipient.email' => $email)));
		return $recipient;
	}
	
	private function getRecipientByUserId($user_id){
		// returns recipient if existing
		$recipient = $this->NewsletterRecipient->find('first', array(
			'conditions' => array(
				'NewsletterRecipient.user_id' => $user_id)));
		return $recipient;
	}
	
	private function checkRecipientIsActive($recipient){
		$isActive = $recipient['NewsletterRecipient']['active'];
		return $isActive;
	}
	
	public function unSubscribe(){
		if ($this->request->is('post')){
			// check if recipient exists
			if($recipient = $this->getRecipient($this->request->data['NewsletterRecipient']['email'])){
				// check if recipient is active
				if($this->checkRecipientIsActive($recipient)){
					// inactivate recipient
					$recipient = $this->setRecipientInactive($recipient);
					$action = 'delete'; 
				} else {
					// else activate recipient
					$recipient = $this->setRecipientActive($recipient);
					$action = 'add';
				}		
			} else {
				
				// if recipient doesn't exist, create a new one
				$recipient = $this->createNewRecipient($this->request->data['NewsletterRecipient']['email'], NULL);
				$action = 'add';
			}
			// update or save recipient
			$this->saveRecipient($recipient, $action);
		}
		// get back to calling page
		$this->redirect($this->referer());
	}
	
	public function userUnSubscribe(){
		if ($this->request->is('post')){
			$user = $this->Auth->user();
			debug($user['user_id']);
			if($recipient = $this->getRecipientByUserId($user['user_id'])){
				// check if recipient is active
				debug($recipient);
				if($this->checkRecipientIsActive($recipient)){
					// inactivate recipient
					$recipient = $this->setRecipientInactive($recipient);
					$action = 'delete';
				} else {
					// else activate recipient
					$recipient = $this->setRecipientActive($recipient);
					$action = 'add';
				}
			} else {
				// if recipient doesn't exist, create a new one
				$recipient = $this->createNewRecipient(NULL,$user['id']);
				$action = 'add';
			}
			// update or save recipient
			$this->NewsletterRecipient->set($recipient);
			$this->NewsletterRecipient->save();
			$this->saveRecipient($recipient, $action);
		}
//		$this->redirect($this->referer());
	}
	
	private function setRecipientInactive($recipient){
		$recipient['NewsletterRecipient']['active'] = 0;
		return $recipient;
	}
	
	public function setRecipientInactiveByEmail($email){
		$recipient = $this->getRecipient($email);
		$recipient = $this->setRecipientInactive($recipient);
		$action = 'delete';
		$this->saveRecipient($recipient, $action);
		$this->redirect($this->referer());
	}
	
	private function setRecipientActive($recipient){
		$recipient['NewsletterRecipient']['active'] = 1;
		return $recipient;
		
	}
	
	private function saveRecipient($recipient, $action){
		$this->NewsletterRecipient->set($recipient);
		if($this->NewsletterRecipient->save()) {
			if ($action == 'add'){
				$this->Session->setFlash('The user was added successfully.', 'default', array(
					'class' => 'flash_success'), 
					'NewsletterRecipient');
			} else {
				$this->Session->setFlash('The user was removed successfully.', 'default', array(
				'class' => 'flash_success'), 
				'NewsletterRecipient');
			}
		} else {
			$this->Session->setFlash('The user was not added.', 'default', array(
			'class' => 'flash_failure'), 
			'NewsletterRecipient');
			$this->_persistValidation('NewsletterRecipient');
		}
	}
	
	private function createNewRecipient($email,$user_id){
		// create new recipient from post data
		$recipient = array(
			'email' => $email,
			'user_id' => $user_id,
			'active' => '1'
		);
		return $recipient;
	}
	
	public function addRecipient(){
		if ($this->request->is('post')){
			$recipient = $this->getRecipient($this->request->data['NewsletterRecipient']['email']);
			if (($recipient) && (($this->checkRecipientIsActive($recipient)) == 0)){
				$recipient = $this->setRecipientActive($recipient);
			} else {
				$recipient = $this->createNewRecipient($this->request->data['NewsletterRecipient']['email'], NULL);
			}	
			$action = 'add';
			$this->saveRecipient($recipient, $action);		
		}
		$this->redirect($this->referer());
	}
	
	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
}