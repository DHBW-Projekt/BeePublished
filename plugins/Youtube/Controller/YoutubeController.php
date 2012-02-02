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
* @description functions for admin overlay
* 			   either getting data from database or
* 			   saving a new link
*/
class YoutubeController extends YoutubeAppController{
	
	public $uses = array('Youtube.YoutubeLink');
	
	function admin($contentId){
		// set layout
		$this->layout = 'overlay';
		// set contentId used for settings
		$this->set('contentId', $contentId);
		// get current link to display
		$currentLink = $this->YoutubeLink->find('first', array('conditions' => array('contentId' => $contentId), 'fields' => array('YoutubeLink.url')));
		// work on value to get a working url before setting it
		$this->set('currentLink', str_replace('embed/', 'watch?v=', $currentLink['YoutubeLink']['url']));

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