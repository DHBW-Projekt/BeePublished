<?php

App::uses('Sanitize','Utility');
App::import('Vendor','recaptcha/recaptchalib');

class GuestbookPostController extends GuestbookAppController {

	public $name = 'Guestbook';
	public $uses = array('Guestbook.GuestbookPost');
	public $components = array('BeeEmail', 'Config');
	public $helpers = array('Time', 'Form');

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('save', 'release_noAuth', 'delete_noAuth');
	}

	function save(){
		// get is not allowed
		if ($this->request->is('post')){
			// prevent harmful code
			$newPost = Sanitize::clean($this->request->data);
			// generate acivation token for mail
			$salt = rand(0, 100);
			$newPost['GuestbookPost']['token'] = md5($salt . $newPost['GuestbookPost']['author'] . $salt . $newPost['GuestbookPost']['title'] . $salt);
			// call validate for model with entered values
			$this->GuestbookPost->set($newPost);
			if ($this->GuestbookPost->validates()) {
				// there are no errors -> check captcha
				$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
				$resp = recaptcha_check_answer($privatekey,
													$_SERVER["REMOTE_ADDR"],
													$_POST["recaptcha_challenge_field"],
													$_POST["recaptcha_response_field"]);
				if (!$resp->is_valid) {
					// error in captcha -> set error message and redirect back to form
					$this->Session->setFlash(__('The reCAPTCHA wasn\'t entered correctly. Please try again.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
					$this->_persistValidation('GuestbookPost');
					$this->redirect($this->referer());
				} else {
					// captcha was succesfull
					// save post without validating again
					$this->GuestbookPost->save($newPost, array('validate' => false));
					// delete validation from session
					$this->_deleteValidation();	
// 					// prepare and send email to specified email with values and links
// 					$to = $this->ConfigComponent->getValue('email');
// 					$subject = __('There is a new post for your guestbook!');
// 					$viewVars = array('author' => $newPost['author'],
// 										'title' => $newPost['title'],
// 										'text' => $newPost['text'],
// 										'submitDate' => $this->Time->format('d.m.Y', $newPost['created']) . ' ' . $this->Time->format('H:i:s',$newPost['created']),
// 										'url_release' => $this->Form->postLink('here', 
// 																			array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost', 'action' => 'release_noAuth', $newPost['id'], $newPost['token']),
// 																			array('title' => __('Release post'))),
// 										'url_delete' => $this->Form->postLink('here', 
// 																			array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost', 'action' => 'delete_noAuth', $newPost['id'], $newPost['token']),
// 																			array('title' => __('Delete post')),
// 																			__('Do you really want to delete this post?')),
// 										'page_name' => $this->ConfigComponent->getValue('page_name'));
// 					$viewName = 'Guestbook.notification';
// 					$this->BeeEmail->sendHtmlEmail($to, $subject, $viewVars, $viewName);
					// set positive message and redirect to page
					$this->Session->setFlash(__('Your post was saved. It will be released by an administrator.'), 'default', array('class' => 'flash_success'), 'Guestbook.Main');
					$this->redirect($this->referer());
				}
			}
			// if errors occur set error message, save validation and data in session
			$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
			$this->_persistValidation('GuestbookPost');
			$this->redirect($this->referer());	
		}
	}

	function delete($id = null){
		// get id from link
		$this->GuestbookPost->id = $id;
		// get is not allowed for delete function
		if ($this->request->is('get')){
			throw new MethodNotAllowedException();
		}
		else{
			//delete post from database and set positive message
			if ($this->GuestbookPost->delete($id)) {
				$this->Session->setFlash(__('Post deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Main');
				$this->redirect($this->referer());
			}
			// if errors occur set error message
			$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
			$this->redirect($this->referer());
		}
	}

	function release_noAuth($id = null, $token = null){
		// get id from link
		$this->GuestbookPost->id = $id;
		// get data for post
		$onePost = $this->GuestbookPost->read();
		// check for valid token -> if invalid set error msg
		if ($onePost['token'] != $token){
			$this->Session->setFlash(__('Token is invalid. Post was not released.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// token valid -> set released date
		$onePost['GuestbookPost']['released'] = date("Y-m-d H:i:s");
		// save changed (released) post
		if ($this->GuestbookPost->save($onePost)) {
			// save succesfull -> set positive message
			$this->Session->setFlash(__('Post released.'), 'default', array('class' => 'flash_success'));
			$this->redirect('/');
		}
		// error occured during save -> set error msg
		$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'));
		$this->redirect('/');
	}

	function delete_noAuth($id = null, $token = null){
		// get id from link
		$this->GuestbookPost->id = $id;
		// get data for post
		$onePost = $this->GuestbookPost->read();
		// check for valid token -> if invalid set error msg
		if ($onePost['token'] != $token){
			$this->Session->setFlash(__('Token is invalid. Post was not released.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		//delete post from database and set positive message
		if ($this->GuestbookPost->delete($id)) {
			$this->Session->setFlash(__('Post deleted.'), 'default', array('class' => 'flash_success'));
			$this->redirect('/');
		}
		// if errors occur set error message
		$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'));
		$this->redirect('/');
	}
}