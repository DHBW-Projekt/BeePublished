<?php

class LocationController extends AppController {
	
	public $components = array('ContentValueManager');
	var $layout = 'overlay';
	
	public function admin($contentID){	
		$this->loadModel("GoogleMapsLocation");
		
		$contentValue = $this->ContentValueManager->getContentValues($contentID);
		if (isset($contentValue['LocationID'])) {
			$currentLocation = $this->GoogleMapsLocation->find('first', array('conditions' => array('GoogleMapsLocation.id' => $contentValue['LocationID'])));
		} else {
			$currentLocation = null;
		}
		
		$this->set('locations', $this->GoogleMapsLocation->find('all'));
		$this->set('currentLocation', $currentLocation);
		$this->set('contentID', $contentID);
	}
	
	function setLocation($contentID, $locationID) {		
		$contentValue['LocationID'] = $locationID;
		$this->ContentValueManager->saveContentValues($contentID, $contentValue);

		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function remove($contentID, $locationID) {
		$this->loadModel("GoogleMapsLocation");
		$this->loadModel("ContentValues");
		
		$this->GoogleMapsLocation->delete($locationID);
		
		$contentValue = $this->ContentValues->set($this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID))));
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
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}