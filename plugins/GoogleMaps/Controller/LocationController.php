<?php

class LocationController extends AppController {
		
	var $layout = 'overlay';
	
	public function admin($contentID){	
		$this->loadModel("GoogleMapsLocation");
		
		$contentValue = $this->_getContentValue($contentID);
		if ($contentValue['ContentValues']['key'] == 'LocationID') {
			$currentLocation = $this->GoogleMapsLocation->find('first', array('conditions' => array('GoogleMapsLocation.id' => $contentValue['ContentValues']['value'])));
		} else {
			$currentLocation = null;
		}
		
		$this->set('locations', $this->GoogleMapsLocation->find('all'));
		$this->set('currentLocation', $currentLocation);
		$this->set('contentID', $contentID);
	}
	
	function setLocation($contentID, $locationID) {
		$this->loadModel("ContentValues");
		
		$this->ContentValues->set($this->_getContentValue($contentID));
		$this->ContentValues->set('content_id', $contentID);
		$this->ContentValues->set('key', 'LocationID');
		$this->ContentValues->set('value', $locationID);
		$this->ContentValues->save();
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function remove($contentID, $locationID) {
		$this->loadModel("GoogleMapsLocation");
		$this->loadModel("ContentValues");
		
		$this->GoogleMapsLocation->delete($locationID);
		
		$contentValue = $this->ContentValues->set($this->_getContentValue($contentID));
		if ($contentValue['ContentValues']['key'] == 'LocationID' and $contentValue['ContentValues']['value'] == $locationID) {
			$this->ContentValues->delete($contentValue['ContentValues']['id']);
		}
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function create($contentID) {
		$this->loadModel("GoogleMapsLocation");
		
		if (!empty($this->data)) {
    		$this->GoogleMapsLocation->save($this->data);
    		$this->setLocation($contentID, $this->GoogleMapsLocation->id);
    	}
		
    	$this->set('contentID', $contentID);
	}
	
	function _getContentValue($contentID) {
		$this->loadModel("ContentValues");
		
		return $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
	}
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}