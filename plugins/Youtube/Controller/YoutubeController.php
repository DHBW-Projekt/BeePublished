<?php

class YoutubeController extends YoutubeAppController{
	
	public $uses = array('Youtube.YoutubeLink');
	
	function admin($contentId){
		// set layout
		$this->layout = 'overlay';
		// set contentId used for settings
		$this->set('contentId', $contentId);
		
		if ($this->request->is('post')){
			// get data from post
			$newLink = $this->request->data;
			// check whether a link for this content is already present -> get id and add it to variable
			$update = $this->YoutubeLink->find('first', array('conditions' => array('contentId' => $contentId), 'fields' => array('YoutubeLink.id')));
			if (!empty($update)){
				$newLink['YoutubeLink']['id'] = $update['YoutubeLink']['id'];
			}
			// set content id
			$newLink['YoutubeLink']['contentId'] = $contentId;
			// work on URL to get an 'embed' version
			$newLink['YoutubeLink']['url'] = str_replace('watch?v=', 'embed/', $newLink['YoutubeLink']['url']);	
			$pos_end = strpos($newLink['YoutubeLink']['url'], '&');
			if ($pos_end != 0){
				$newLink['YoutubeLink']['url'] = substr($newLink['YoutubeLink']['url'], 0, $pos_end);
			}
			// save and set message
			if (!$this->YoutubeLink->save($newLink)){
				$this->_persistValidation('YoutubeLink');
				$this->Session->setFlash(__d('Youtube', 'An error occured.'), 'default', array('class' => 'flash_failure'), 'Youtube.Admin');
				$this->redirect($this->referer());
			}
			$this->_deleteValidation();
			$this->Session->setFlash(__d('Youtube', 'Save succesful.'), 'default', array('class' => 'flash_success'), 'Youtube.Admin');
			$this->redirect($this->referer());
		}
	}
}