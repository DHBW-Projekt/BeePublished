<?php

class GuestbookController extends AppController {

	public $uses = array('Guestbook.GuestbookPost');

	public function admin(){
		$this->layout = 'overlay';
		$this->set('unreleasedPosts', $this->GuestbookPost->find('all', array('conditions' => array('released' => '0000-00-00 00:00:00'))));
	}

	function maintenance(){
		if(array_key_exists('release', $this->request->data)){
			$this->_release();
		}
		if(array_key_exists('delete', $this->request->data)){
			$this->_delete();
		}
	}

	function _release(){
		// prepare variables
		$index = 0;
		// get data
		$allPosts = $this->request->data;
		// search for checked posts
		foreach($allPosts['GuestbookPost'] as $id => $post){
			if ($post['ckecked'] == 1){
				// post is checked -> get id and read data into model
				$this->GuestbookPost->id = $id;
				$onePost = $this->GuestbookPost->read();
				// set released with current date and time
				$onePost['GuestbookPost']['released'] = date("Y-m-d H:i:s");
				// save changed posts
				// if error occurs abort all remaining and set error message
				if (!$this->GuestbookPost->save($onePost)) {
					$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
					$this->redirect($this->referer());
				}
				$index++;
			}
		}
		// if no error occured set positive message (text is depending on number of posts)
		if ($index == 0){
			$this->redirect($this->referer());
		}
		else if ($index == 1){
			$this->Session->setFlash(__('Post released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('Posts released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		}

	}

	function _delete(){
		// prepare variables
		$index = 0;
		// get data
		$allPosts = $this->request->data;
		// search for checked posts
		foreach($allPosts['GuestbookPost'] as $id => $post){
			if ($post['ckecked'] == 1){
				// delete post
				// if error occurs abort all remaining and set error message
				if (!$this->GuestbookPost->delete($id)) {
					$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
					$this->redirect($this->referer());
				}
				$index++;
			}
		}
		// if no error occured set positive message (text is depending on number of posts)
		if ($index == 0){
			$this->redirect($this->referer());
		}
		else if ($index == 1){
			$this->Session->setFlash(__('Post deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('Posts deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		}
	}
}