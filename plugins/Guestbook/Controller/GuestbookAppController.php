<?php

class GuestbookAppController extends AppController {

	public $name = 'GuestbookApp';
	public $uses = array('Guestbook.GuestbookPost');

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		//TODO change to save
		$this->Auth->allow('*'); 
	}

	function save(){
		if ($this->request->is('post')){
			if ($this->GuestbookPost->save($this->request->data)) {
				$this->Session->setFlash(__('Der Eintrag wurde gespeichert.
										    Er wird von einem Administrator überprüft und dann freigegeben.'));
				$this->redirect($this->referer());
			}		
			
//			$this->set('errors', $this->GuestbookPost->validationErrors);
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

