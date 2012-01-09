<?php

App::uses('Sanitize','Utility');

class GuestbookAppController extends AppController {
	
	public $name = 'GuestbookApp';
	public $uses = array('Guestbook.GuestbookPost');
	public $components = array('PermissionValidation');
	
	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		//TODO change to save
		$this->Auth->allow('save'); 
	}

	function save(){
		if ($this->request->is('post')){
			$this->request->data = Sanitize::clean($this->request->data);
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->delete('input');
				$this->_deleteValidation();
				$this->Session->setFlash(__('Der Eintrag wurde gespeichert.
										   				 Er wird von einem Administrator überprüft und dann freigegeben.'), 'default', array('class' => 'flash_success'), 'Guestbook');
				$this->redirect($this->referer());
			}		
			$this->Session->setFlash(__('Es sind Fehler aufgetreten.'), 'default', array('class' => 'flash_failure'), 'Guestbook');
			$this->_persistValidation('GuestbookPost');
			$this->Session->write('input', $this->request->data);
			$this->redirect($this->referer());
		}
	}

	function release($id = null){
		$this->GuestbookPost->id = $id;
		if ($this->request->is('get')){
			$this->request->data = $this->GuestbookPost->read();
			$this->request->data['GuestbookPost']['released'] = date("Y-m-d H:i:s");
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->setFlash(__('Der Eintrag wurde freigegeben.'), 'default', array('class' => 'flash_success'), 'Guestbook');
				$this->redirect($this->referer());
			}
		}
	}

	function delete($id = null){
		$this->GuestbookPost->id = $id;
		if ($this->request->is('get')){
			$this->request->data = $this->GuestbookPost->read();
			$this->request->data['GuestbookPost']['deleted'] = date("Y-m-d H:i:s");
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->setFlash(__('Der Eintrag wurde entfernt.'), 'default', array('class' => 'flash_success'), 'Guestbook');
				$this->redirect($this->referer());
			}
		}
	}
}

