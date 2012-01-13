<?php

App::uses('Sanitize','Utility');

class GuestbookPostController extends GuestbookAppController {

	public $name = 'Guestbook';
	public $uses = array('Guestbook.GuestbookPost');
	public $components = array('PermissionValidation');

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('save');
	}

	function save(){
		if ($this->request->is('post')){
			// prevent harmful code
			$this->request->data = Sanitize::clean($this->request->data);
			// call save for model with entered values
			// if no errors occur delete validation and data saved in session, set positive message
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->delete('input');
				$this->_deleteValidation();
				$this->Session->setFlash(__('Your post was saved. It will be released by an administrator.'), 'default', array('class' => 'flash_success'), 'Guestbook.WritePost');
				$this->redirect($this->referer());
			}
			// if errors occur set error message, save validation and input data in session
			$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.WritePost');
			$this->_persistValidation('GuestbookPost');
			$this->Session->write('input', $this->request->data);
			$this->redirect($this->referer());
		}
	}

	function delete($id){
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
}