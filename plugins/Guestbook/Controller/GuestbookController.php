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
* @description Used for admin overlay
* 			   admin gets values to display // decides which action was clicked
* 			   settigns to change default values / configuration
* 			   clean_db if posts are not deleted immediately to free up database
* 			   _release to release 1 to n posts
* 			   _delete to delete 1 to n posts
*/
class GuestbookController extends GuestbookAppController {

	public $uses = array('Guestbook.GuestbookPost');
	public $components = array ('ContentValueManager', 'Guestbook.GuestbookContentValues');

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
			$this->set('unreleasedPosts', $this->GuestbookPost->find('all', array('conditions' => array('contentId' => $contentId,
																				  'released' => '0000-00-00 00:00:00',
																				  'deleted' => '0000-00-00 00:00:00'))));
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
			$this->Session->setFlash(__d('guestbook', 'Your settings were saved.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else{
			// get current values
			$this->set('posts_per_page', $this->GuestbookContentValues->getValue($contentId, 'posts_per_page'));
			$this->set('send_emails', $this->GuestbookContentValues->getValue($contentId, 'send_emails'));
			$this->set('delete_immediately', $this->GuestbookContentValues->getValue($contentId, 'delete_immediately'));
		}
	}
	
	function clean_db($contentId){
		$this->layout = 'overlay';
		// set contentId used for settings
		$this->set('contentId', $contentId);
		// check request
		if($this->request->is('post')){
			// delete flagged posts from db
			if ($this->GuestbookPost->deleteAll(array('contentId' => $contentId,
												  'deleted NOT' => '0000-00-00 00:00:00'))){
			$this->Session->setFlash(__d('guestbook', 'Database cleaned.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
			}
			else {
				$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
				$this->redirect($this->referer());
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
				$onePost = $this->GuestbookPost->find('first', array('conditions' => array('GuestbookPost.id' => $id)));
				// set released with current date and time
				$onePost['GuestbookPost']['released'] = date("Y-m-d H:i:s");
				// save changed posts
				if (!$this->GuestbookPost->save($onePost)) {
					// error occured -> abort all remaining and set error message
					$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
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
			$this->Session->setFlash(__d('guestbook', 'Post released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__d('guestbook', 'Posts released.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		}

	}

	/* intern function called by admin() function.
	 * There is no ckeck for delete settings as this function is used
	 * to delete unreleased or previousliy soft deleted posts.
	 * Soft deleted means that only a flag is set. This happens for released posts
	 * that are deleted while 'delete_immediately' setting is 'no'. */
	function _delete(){
		// prepare variables -> used for succes message
		$index = 0;
		// get data
		$allPosts = $this->request->data;
		// search for checked posts
		foreach($allPosts['GuestbookPost'] as $id => $post){
			if ($post['ckecked'] == 1){
				//delete post from database and set positive message
				if (!$this->GuestbookPost->delete($id)) {
					// errors occured -> set error message
					$this->Session->setFlash(__d('guestbook', 'An error has occured.'), 'default', array('class' => 'flash_failure'), 'Guestbook.Admin');
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
			$this->Session->setFlash(__d('guestbook', 'Post deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__d('guestbook', 'Posts deleted.'), 'default', array('class' => 'flash_success'), 'Guestbook.Admin');
			$this->redirect($this->referer());
		}
	}	
}