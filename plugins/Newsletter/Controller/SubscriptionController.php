<?php
App::uses('CakeEmail', 'Network/Email');
class SubscriptionController extends AppController {
		
	public $name = 'Subscription';
	public $uses = array('Newsletter.NewsletterRecipient', 'User');
 	public $helpers = array('Fck');
//  	public $layout = 'overlay';

//  	public $paginate = array(
//  	'NewsletterLetter' => array(
//  	'limit' => 5,
//  	'order' => array(
//  	'NewsletterLetter.date' => 'desc')));
 	
 	public function admin($contentID){
//  		$newsletters = $this->paginate('NewsletterLetter');
 		
 	
 		// 		$NewsletterRecipientsController->index();
 		// 		$user = $this->Auth->user();
 		// 		$email = $user['email'];
 		// 		$recipient = $this->getRecipientByEmail($email);
 		// 		$isRecipient = $this->checkRecipientIsActive($recipient);
 		// 		print_r($isRecipient);
 		// 		$this->set('isRecipient', $isRecipient);
 		$this->layout = 'overlay';
//  		$this->set('newsletters', $newsletters);
//  		$this->render('/NewsletterLetters/index');
 		// 		$this->getAndSetData();
 	}
 	
 	public function guestUnSubscribe(){
 		if ($this->request->is('post')){
 			// check if recipient exists
 			// 			debug($this->request->data);
 			if($recipient = $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// 			if($recipient = $this->getRecipientByEmail($this->request->data['NewsletterRecipient']['email'])){
 				// check if recipient is active
 				if($recipient['NewsletterRecipient']['active'] == 1){
 					// 				if($this->checkRecipientIsActive($recipient)){
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
 			} else {
 				// if recipient doesn't exist, create a new one
 				$this->add();
 			}
 		}
 		// get back to calling page
 		$this->redirect($this->referer());
 	}
 	
 	public function userUnSubscribe(){
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
 			$this->redirect($this->referer());
 		}
 	}
 	
 	public function add(){
 		if ($this->request->is('post')){
 			// 			debug($this->data);
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
 		$this->redirect($this->referer());
 	}
 	
//  var $autoLayout = false;
// 	var $autoRender = false;
		
 	
 	// general functions:
 	
// 	public $paginate = array(
// 		'NewsletterLetter' => array(
// 			'limit' => 5, 
// 			'order' => array(
// 				'NewsletterLetter.date' => 'desc')),
// 		 'NewsletterRecipient' => array(
// 			'limit' => 10,
// 			'order'	=> array(
// 				'NewsletterRecipient.email' => 'asc'),
// 			'conditions' => array(
// 				'NewsletterRecipient.active' => 1)),
// 		'EmailTemplate' => array(
// 			'limit' => 10,
// 			'order' => array(
// 				'EmailTemplate.id' => 'asc'))
// 	);
	
// 	private function getAndSetData(){
// 		$newsletters = $this->getNewsletters();
// 		$recipients = $this->getActiveRecipients();
// 		$this->set(array(
// 				'newsletters' => $newsletters,
// 				'recipients' => $recipients
// 		));
// 	}
	

	
// 	public function newsletteradmin(){
// 		$this->getAndSetData();
// 		$this->set('mode', '');
// 		$this->layout = 'overlay';
// 		$this->render('admin');
// 	}
	
// 	// Newsletter administration
	
// 	private function getNewsletters(){
// 		$newsletters = $this->paginate('NewsletterLetter');
// 		return $newsletters;
// 	}
	
// 	public function createNewsletter(){
// 		$newsletterToEdit = array(
// 				'subject' => NULL,
// 				'content' => NULL,
// 				'id' => 'new');
// 		$this->set(array(
// 				'newsletterToEdit' => $newsletterToEdit,
// 				'mode' => 'edit'));
// 		$this->getAndSetData();
// 		$this->layout = 'overlay';
// 		$this->render('admin');
// 	}
	
// 	public function editNewsletter($id){
// 		$newsletterToEdit = $this->NewsletterLetter->find('first', array(
// 				'conditions' => array(
// 					'NewsletterLetter.id' => $id)));
// 		$newsletterToEdit = $newsletterToEdit['NewsletterLetter'];
// 		$this->set(array(
// 				'newsletterToEdit' => $newsletterToEdit,
// 				'mode' => 'edit'));
// 		$this->getAndSetData();
// 		$this->layout = 'overlay';
// 		$this->render('admin');
// 	}
	
// 	public function saveNewsletter($newsletter_id){
// 		if ($this->request->is('post')){
// 			$newsletter2 = $this->request->data['NewsletterLetter'];
// 			if (!($newsletter_id == 'new')){
// 				$newsletter = $this->NewsletterLetter->findById($newsletter_id);
// 			} else {
// 				$newsletter = array();
// 			};
// 			$newsletter['NewsletterLetter']['subject'] = $newsletter2['subject'];
// 			$newsletter['NewsletterLetter']['content'] = $newsletter2['content'];
// 			$newsletter['NewsletterLetter']['draft'] = 1;
// 			$date = date('Y-m-d', time());
// 			$newsletter['NewsletterLetter']['date'] = $date;
// 			$this->NewsletterLetter->set($newsletter);
// 			$newsletter = $this->NewsletterLetter->save();
// 			$newsletter = $newsletter['NewsletterLetter'];
	
// 			// 			debug($newsletter);
// 			$this->editNewsletter($newsletter['id']);
	
// 		}
// 		// 		$this->redirect($this->referer());
// 	}
		
// 	public function previewNewsletter($id){
// 		$newsletterToPreview = $this->NewsletterLetter->find('first', array(
// 			'conditions' => array(
// 				'NewsletterLetter.id' => $id)));
// 		$newsletterToPreview = $newsletterToPreview['NewsletterLetter'];
// 		$this->set(array(
// 			'newsletterToPreview' => $newsletterToPreview,
// 			'mode' => 'preview'));
// 		$this->getAndSetData();
// 		$this->layout = 'overlay';
// 		$this->render('admin');
// 	}
	
// 	public function deleteNewsletter($id){
// 		$this->NewsletterLetter->delete($id);
// 		$this->redirect($this->referer());
// 	} 
	
// 	public function sendNewsletter($newsletter_id) {
// 		//debug($newsletter['NewsletterLetter']['content']);
// 		$newsletter = $this->NewsletterLetter->findById($newsletter_id);
		
// 		$email = new CakeEmail();
//     	$email->emailFormat('html')
//     			->template('Newsletter.newsletter', 'email')
// 				->subject($newsletter['NewsletterLetter']['subject'])
// 				->to('tobiashoehmann@googlemail.com')
// 				->from('noreply@DualonCMS.de', 'DualonCMS')
// 				->viewVars(array('text' => $newsletter['NewsletterLetter']['content']
//         		))
//         		->send();
// 		$this->redirect('/plugin/Newsletter/Subscription/newsletteradmin/');
// 	}
	
// 	// Recipients list administration
	
// 	private function getActiveRecipients(){
// 		$recipients = $this->paginate('NewsletterRecipient');
// 		return $recipients;
// 	}
	
// 	public function guestUnSubscribe(){
// 		if ($this->request->is('post')){
// 			// check if recipient exists
// 			if($recipient == $this->NewsletterRecipient->findByEmail($this->request->data['NewsletterRecipient']['email'])){
// // 			if($recipient = $this->getRecipientByEmail($this->request->data['NewsletterRecipient']['email'])){
// 				// check if recipient is active
// 				if($this->checkRecipientIsActive($recipient)){
// 					// inactivate recipient
// 					$recipient = $this->setRecipientInactive($recipient);
// 					$action = 'delete';
// 				} else {
// 					// else activate recipient
// 					$recipient = $this->setRecipientActive($recipient);
// 					$action = 'add';
// 				}
// 			} else {
// 				// if recipient doesn't exist, create a new one
// 				$recipient = $this->createNewRecipient($this->request->data['NewsletterRecipient']['email'], NULL);
// 				$action = 'add';
// 			}
// 			// update or save recipient
// 			$this->saveRecipient($recipient, $action);
// 		}
// 		// get back to calling page
// // 		$this->redirect($this->referer());
// 	}	
	
// 	public function userUnSubscribe(){
// 		if ($this->request->is('post')){
// 			$user = $this->Auth->user();
// // 			debug($user);
// 			if($recipient = $this->getRecipientByUserId($user['id'])){
// 				// check if recipient is active
// // 				debug($recipient);
// 				if($this->checkRecipientIsActive($recipient)){
// 					// inactivate recipient
// 					$recipient = $this->setRecipientInactive($recipient);
// 					$action = 'delete';
// 				} else {
// 					// else activate recipient
// 					$recipient = $this->setRecipientActive($recipient);
// 					$action = 'add';
// 				}
// 			} else {
// 				// if recipient doesn't exist, create a new one
// 				$recipient = $this->createNewRecipient('user@fake.de',$user['id']);
// 				$action = 'add';
// 			}
// 			// update or save recipient
// 			$this->saveRecipient($recipient, $action);
// 		}
// 				$this->redirect($this->referer());
// 	}
	
// 	private function getRecipientByEmail($email){
// 		// returns recipient if existing
// 		$recipient = $this->NewsletterRecipient->find('first', array(
// 			'conditions' => array(
// 				'NewsletterRecipient.email' => $email)));
// 		return $recipient;
// 	}
	
// 	private function getRecipientByUserId($user_id){
// 		// returns recipient if existing
// 		$recipient = $this->NewsletterRecipient->find('first', array(
// 			'conditions' => array(
// 				'NewsletterRecipient.user_id' => $user_id)));
// 		return $recipient;
// 	}
	
// 	private function checkRecipientIsActive($recipient){
// 		$isActive = $recipient['NewsletterRecipient']['active'];
// 		return $isActive;
// 	}
	
// 	private function setRecipientInactive($recipient){
// 		$recipient['NewsletterRecipient']['active'] = 0;
// 		return $recipient;
// 	}
	
// 	public function setRecipientInactiveByEmail($email){
// 		$recipient = $this->getRecipientByEmail($email);
// 		$recipient = $this->setRecipientInactive($recipient);
// 		$action = 'delete';
// 		$this->saveRecipient($recipient, $action);
// 		$this->redirect($this->referer());
// 	}
	
// 	private function setRecipientActive($recipient){
// 		$recipient['NewsletterRecipient']['active'] = 1;
// 		return $recipient;
// 	}
	
// 	private function saveRecipient($recipient, $action){
// // 		debug($recipient);
// 		$this->NewsletterRecipient->set($recipient);
// // 		debug($recipient);
// // 		debug($this->NewsletterRecipient->save());
// 		if($this->NewsletterRecipient->save()) {
// 			if ($action == 'add'){
// 				$this->Session->setFlash('The user was added successfully.', 'default', array(
// 					'class' => 'flash_success'), 
// 					'NewsletterRecipient');
// 			} else {
// 				$this->Session->setFlash('The user was removed successfully.', 'default', array(
// 				'class' => 'flash_success'), 
// 				'NewsletterRecipient');
// 			}
// 		} else {
// 			$this->Session->setFlash('The user was not added.', 'default', array(
// 			'class' => 'flash_failure'), 
// 			'NewsletterRecipient');
// 			$this->_persistValidation('NewsletterRecipient');
// 		}
// 	}
	
// 	private function createNewRecipient($email,$user_id){
// 		// create new recipient from post data
// 		$recipient = array(
// 			'NewsletterRecipient' => array(
// 				'email' => $email,
// 				'user_id' => $user_id,
// 				'active' => '1'));
// 		return $recipient;
// 	}
	
// 	public function addRecipient(){
// 		if ($this->request->is('post')){
// 			$recipient = $this->getRecipientByEmail($this->request->data['NewsletterRecipient']['email']);
// 			if (($recipient) && (($this->checkRecipientIsActive($recipient)) == 0)){
// 				$recipient = $this->setRecipientActive($recipient);
// 			} else {
// 				$recipient = $this->createNewRecipient($this->request->data['NewsletterRecipient']['email'], NULL);
// 			}	
// 			$action = 'add';
// 			$this->saveRecipient($recipient, $action);		
// 		}
// 		$this->redirect($this->referer());
// 	}
	
	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
}