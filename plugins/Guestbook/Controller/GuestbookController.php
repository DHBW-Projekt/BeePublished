<?php

class GuestbookController extends AppController {

	public $uses = array('Guestbook.GuestbookPost');

	public function admin(){
		$this->layout = 'overlay';
		$this->set('unreleasedPosts', $this->GuestbookPost->find('all', array('conditions' => array('released' => '0000-00-00 00:00:00'))));
	}

	function release(){
		// prepare variables
		$index = 0;
		$toRelease = array();
		// get data
		$allUnreleasedPosts = $this->request->data;
		// search for checked posts
		foreach($allUnreleasedPosts['GuestbookPost'] as $id => $post){
			if ($post['toRelease'] == 1){
				// post is checked -> get id and read data into model
				$this->GuestbookPost->id = $id;
				$onePost = $this->GuestbookPost->read();
				// set released with current date and time
				$onePost['GuestbookPost']['released'] = date("Y-m-d H:i:s");
				// add this post to an array containing all posts which should be released
				$toRelease[$index] = $onePost;
				$index++;
			}
		}		
		// save changed posts and set positive message (text is depending on number of posts)
		if ($this->GuestbookPost->saveMany($toRelease)) {
			if ($index == 1){
				$this->Session->setFlash(__('Post released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('Posts released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
				$this->redirect($this->referer());
			}
		}
		// if errors occur set error message
		$this->Session->setFlash(__('An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
		$this->redirect($this->referer());
	}

}