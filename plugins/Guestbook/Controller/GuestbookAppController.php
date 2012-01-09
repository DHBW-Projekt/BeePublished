<?php

// App::uses('Sanitize');

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
// 		die(debug($this->request->data));
		if ($this->request->is('post')){
// 			$this->request->data = Sanitize::clean($this->request->data);
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->delete('input');
				$this->Session->delete('errors');
				$this->Session->setFlash(__('Der Eintrag wurde gespeichert.
										   				 Er wird von einem Administrator überprüft und dann freigegeben.'));
				$this->redirect($this->referer());
			}		
			$this->Session->setFlash(__('Es sind Fehler aufgetreten.'));
			$this->Session->write('input', $this->request->data);
			$this->Session->write('errors', $this->GuestbookPost->validationErrors);
			$this->redirect($this->referer());
		}
	}

	function release($id = null){
		$this->GuestbookPost->id = $id;
		if ($this->request->is('get')){
			$this->request->data = $this->GuestbookPost->read();
			$this->request->data['GuestbookPost']['released'] = date("Y-m-d H:i:s");
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->setFlash(__('Der Eintrag wurde freigegeben.'));
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
				$this->Session->setFlash(__('Der Eintrag wurde entfernt.'));
				$this->redirect($this->referer());
			}
		}
	}
}

