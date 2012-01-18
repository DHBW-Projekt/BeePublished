<?php

class GuestbookController extends AppController {

	public $uses = array('Guestbook.GuestbookPost');
	public $components = array ('ContentValueManager');

	public function admin($contentId){
		// set layout
		$this->layout = 'overlay';
		// set contentId used for settings
		$this->set('contentId', $contentId);
		// check request
		if($this->request->is('post')){
			// determine which action should be done and call function
			if(array_key_exists('release', $this->request->data)){
				$this->_release();
			}
			if(array_key_exists('delete', $this->request->data)){
				$this->_delete();
			}
		} else {
			// request was get so search for data 
			$this->set('unreleasedPosts', $this->GuestbookPost->find('all', array('conditions' => array('released' => '0000-00-00 00:00:00'))));
		}
	}
	
	function settings($contentId){
		// set layout
		$this->layout = 'overlay';
		// set contentId used for settings
		$this->set('contentId', $contentId);
		// check request
		if($this->request->is('post')){
			// save data
			$this->ContentValueManager->saveContentValues($contentId, $this->request->data['settings']);	
			$this->Session->setFlash(__('Your settings were saved.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else{
			// get current values
			$contentValues = $this->ContentValueManager->getContentValues($contentId);
			if (array_key_exists('posts_per_page', $contentValues)){
				$this->set('posts_per_page', $contentValues['posts_per_page']);
			} else {
				$this->set('posts_per_page', '10');
			}
			if (array_key_exists('send_emails', $contentValues)){
				$this->set('send_emails', $contentValues['send_emails']);
			} else {
				$this->set('send_emails', '1');
			}
		}
		
	}
	
	/* intern function called by admin() function */
	function _release(){
		// prepare variables -> used for succes message
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
				if (!$this->GuestbookPost->save($onePost)) {
					// error occured -> abort all remaining and set error message
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

	/* intern function called by admin() function */
	function _delete(){
		// prepare variables -> used for succes message
		$index = 0;
		// get data
		$allPosts = $this->request->data;
		// search for checked posts
		foreach($allPosts['GuestbookPost'] as $id => $post){
			if ($post['ckecked'] == 1){
				// delete post
				if (!$this->GuestbookPost->delete($id)) {
					// error occured -> abort all remaining and set error message
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