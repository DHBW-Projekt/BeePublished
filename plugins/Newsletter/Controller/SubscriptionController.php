<?php
class SubscriptionController extends AppController {
		
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'Newsletter.NewsletterLetter');
 	public $helpers = array('Fck');
	
	
	
	public $paginate = array(
		'NewsletterLetter' => array(
			'limit' => 5, 
			'order' => array('NewsletterLetter.date' => 'desc')
		),
		 'NewsletterRecipient' => array(
			'limit' => 10,
			'order'	=> array('NewsletterRecipient.email' => 'asc'),
			'conditions' => array('NewsletterRecipient.active' => 1)
		)
	);
			
	public function newsletteradmin($id){
		$newsletterToEdit = $this->NewsletterLetter->find('first', array(
														'conditions' => array('NewsletterLetter.id' => $id)));
		$this->set('newsletterToEdit', $newsletterToEdit);
		$this->getAndSetData();
		$this->render('admin');
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
		echo $user['email'];
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
							'conditions' => array('NewsletterRecipient.email' => $email)
			)
		);
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
// 			debug($user, $showHtml=null, $showFrom=true);
			if($recipient = $this->getRecipient($user['email'])){
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
				$recipient = $this->createNewRecipient($user['email'],$user['id']);
				$action = 'add';
			}
			// update or save recipient
			$this->NewsletterRecipient->set($recipient);
			$this->NewsletterRecipient->save();
			$this->saveRecipient($recipient, $action);
		}
		$this->redirect($this->referer());
	}
	
	private function setRecipientInactive($recipient){
		$recipient['NewsletterRecipient']['active'] = 0;
		return $recipient;
	}
	
	public function setRecipientInactiveByEmail($email){
		$recipient = $this->getRecipient($email);
// 		debug($recipient, $showHtml=null, $showFrom=true);
		$recipient = $this->setRecipientInactive($recipient);
// 		debug($recipient, $showHtml=null, $showFrom=true);
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
				$this->Session->setFlash('The user was added successfully.', 'default', array('class' => 'flash_success'), 'NewsletterRecipient');
			} else {
				$this->Session->setFlash('The user was removed successfully.', 'default', array('class' => 'flash_success'), 'NewsletterRecipient');
			}
		} else {
			$this->Session->setFlash('The user was not added.', 'default', array('class' => 'flash_failure'), 'NewsletterRecipient');
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
				$recipient = $this->createNewRecipient();
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
	
	
// 	public function subscribe() {
// 		if ($this->request->is('post')){
// 			$this->NewsletterRecipient->set(array(
// 				'email' => $this->request->data['NewsletterRecipient']['email'],
// 				'active' => '1'));
// 			if($this->NewsletterRecipient->save()) {
// 				$this->Session->setFlash('The user was added successfully.', 'default', array('class' => 'flash_success'), 'NewsletterRecipient');
// 			} else {
// 				$this->Session->setFlash('The user was not added.', 'default', array('class' => 'flash_failure'), 'NewsletterRecipient');
// 				$this->_persistValidation('NewsletterRecipient');
// 			}
// 		}
// 		$this->redirect($this->referer());
// 	}
}