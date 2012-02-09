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
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Sebastian Haase
*
* @description Used for general functions of plugin
* 			   save to save a new post
* 			   delete to delete displayed posts
* 			   release_noAuth for e-mail link
* 			   delete_noAuth for e-mail link
*/
App::import('Vendor','recaptcha/recaptchalib');

class GuestbookPostController extends GuestbookAppController {

	public $name = 'Guestbook';
	public $uses = array('Guestbook.GuestbookPost');
	public $components = array('BeeEmail', 'Config', 'Guestbook.GuestbookContentValues');	

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('save', 'release_noAuth', 'delete_noAuth');
	}

	function save($contentId = null){
		// get is not allowed
		if ($this->request->is('post')){
			// prevent harmful code
			$newPost = $this->request->data;
			// set contentId for post
			$newPost['GuestbookPost']['contentId'] = $contentId;
			// generate acivation token for mail
			$salt = rand(0, 100);
			$newPost['GuestbookPost']['token'] = md5($salt . $newPost['GuestbookPost']['author'] . $salt . $newPost['GuestbookPost']['title'] . $salt);
			// call validate for model with entered values
			$this->GuestbookPost->set($newPost);
			if (!$this->GuestbookPost->validates()) {
				// if errors occur set error message, save validation and data in session
				$this->Session->setFlash(__d('guestbook', 'An error has occured. Please check your data.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
				$this->_persistValidation('GuestbookPost');
				$this->redirect($this->referer());
			}
			// there are no errors -> check captcha
			$privatekey = "6LfzYcwSAAAAAEH-Nr-u6qaFaNdIc6h9nlbm0i76";
			$resp = recaptcha_check_answer($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				// error in captcha -> set error message and redirect back to form
				$this->Session->setFlash(__d('guestbook', 'The reCAPTCHA wasn\'t entered correctly. Please try again.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
				$this->_persistValidation('GuestbookPost');
				$this->redirect($this->referer());
			}
			// captcha was succesfull
			// save post without validating again
			if (!$this->GuestbookPost->save($newPost, array('validate' => false))){
				// if errors occur set error message, save validation and data in session
				$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
				$this->_persistValidation('GuestbookPost');
				$this->redirect($this->referer());
			}
			// no error for saving
			// delete validation from session
			$this->_deleteValidation();	
			// check whether emails should be send
			$send_emails = $this->GuestbookContentValues->getValue($contentId, 'send_emails');
			if ($send_emails == 'yes'){
				// emails should be send -> get data of post again
				$newPost = $this->GuestbookPost->read();
				// get helpers for formatting data and links
				$view = new View($this);
				$Time = $view->loadHelper('Time');
				$Html = $view->loadHelper('Html');
				// prepare and send email to specified email with values and links
				// skip if there is no recipient specified
				$to = $this->Config->getValue('email');
				if ($to != null && $to != ''){
					$subject = __d('guestbook', 'There is a new post for your guestbook!');
					$viewVars = array('author' => $newPost['GuestbookPost']['author'],
									  'title' => $newPost['GuestbookPost']['title'],
									  'text' => $newPost['GuestbookPost']['text'],
									  'submitDate' => $Time->format('d.m.Y', $newPost['GuestbookPost']['created']) . ' ' . $Time->format('H:i:s',$newPost['GuestbookPost']['created']),
									  'url_release' => $Html->link('here', 'http://' . env('SERVER_NAME') . ':' .  env('SERVER_PORT') . $this->webroot . 'plugin/Guestbook/GuestbookPost/release_noAuth/' . $newPost['GuestbookPost']['id'] . '/' . $newPost['GuestbookPost']['token'],
																	array('title' => __d('guestbook', 'Release'))),
									  'url_delete' => $Html->link('here', 'http://' . env('SERVER_NAME') . ':' .  env('SERVER_PORT') . $this->webroot . 'plugin/Guestbook/GuestbookPost/delete_noAuth/' . $newPost['GuestbookPost']['id'] . '/' . $newPost['GuestbookPost']['token'],
																	array('title' => __d('guestbook', 'Delete'))),
									  'page_name' => $this->Config->getValue('page_name'));
					$viewName = 'Guestbook.notification';
					$this->BeeEmail->sendHtmlEmail($to, $subject, $viewVars, $viewName);
				}
			}
			// everything fine -> set positive message
			$this->Session->setFlash(__d('guestbook', 'Your post was saved. It will be released by an administrator.'), 'default', array('class' => 'flash_success'), 'Guestbook.Main');
			$this->redirect($this->referer());
		}
	}

	function delete($contentId = null, $id = null){
		// get is not allowed for delete function
		if ($this->request->is('get')){
			throw new MethodNotAllowedException();
		}
		// check settings for delete
		$delete_immediately = $this->GuestbookContentValues->getValue($contentId, 'delete_immediately');
		if ($delete_immediately == 'no'){
			$onePost = $this->GuestbookPost->find('first', array('conditions' => array('GuestbookPost.id' => $id)));
			// set deleted with current date and time
			$onePost['GuestbookPost']['deleted'] = date("Y-m-d H:i:s");
			// save changed posts
			if (!$this->GuestbookPost->save($onePost)) {
				// errors occured -> set error message
				$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
				$this->redirect($this->referer());
			}
		} elseif ($delete_immediately == 'yes'){
			//delete post from database and set positive message
			if (!$this->GuestbookPost->delete($id)) {
				// errors occured -> set error message
				$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Main');
				$this->redirect($this->referer());
			}
		}
		// everything fine -> set positive message
		$this->Session->setFlash(__d('guestbook', 'Post deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Main');
		$this->redirect($this->referer());
	}

	function release_noAuth($id = null, $token = null){
		// get data for post
		$onePost = $this->GuestbookPost->find('first', array('conditions' => array('GuestbookPost.id' => $id)));
		// check whether post is still existing
		if ($onePost == null || $onePost == ''){
			// set message to notify that post was already deleted
			$this->Session->setFlash(__d('guestbook', 'The post has already been deleted.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// check for valid token 
		if ($onePost['GuestbookPost']['token'] != $token){
			// token is invalid and error message is set
			$this->Session->setFlash(__d('guestbook', 'Token is invalid. Post was not released.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// token valid -> set released date
		$onePost['GuestbookPost']['released'] = date("Y-m-d H:i:s");
		// save changed (released) post
		if (!$this->GuestbookPost->save($onePost)) {
			// error occured during save -> set error msg
			$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// save succesfull -> set positive message
		$this->Session->setFlash(__d('guestbook', 'Post released.'), 'default', array('class' => 'flash_success'));
		$this->redirect('/');
	}

	function delete_noAuth($id = null, $token = null){
		// get data for post
		$onePost = $this->GuestbookPost->find('first', array('conditions' => array('GuestbookPost.id' => $id)));
		// check whether post is still existing
		if ($onePost == null || $onePost == ''){
			// set message to notify that post was already deleted
			$this->Session->setFlash(__d('guestbook', 'The post has already been deleted.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// check for valid token
		if ($onePost['GuestbookPost']['token'] != $token){
			// token is invalid and error message is set
			$this->Session->setFlash(__d('guestbook', 'Token is invalid. Post was not released.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		//delete post from database and set positive message
		if (!$this->GuestbookPost->delete($id)) {
			// an error occured -> set error message
			$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'));
			$this->redirect('/');
		}
		// everything fine -> positive message
		$this->Session->setFlash(__d('guestbook', 'Post deleted.'), 'default', array('class' => 'flash_success'));
		$this->redirect('/');
	}
}