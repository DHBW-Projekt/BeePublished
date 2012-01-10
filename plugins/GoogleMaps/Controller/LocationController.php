<?php

class LocationController extends AppController {
	
	var $components = array('ContentValueManager');
	var $uses = array('GoogleMapsLocation');
	var $layout = 'overlay';
	
	public function admin($contentID){	
		$contentValue = $this->ContentValueManager->getContentValues($contentID);
		if (isset($contentValue['LocationID'])) {
			$currentLocation = $this->GoogleMapsLocation->findById($contentValue['LocationID']);
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
		$this->GoogleMapsLocation->delete($locationID);
		$this->ContentValueManager->removeContentValues($contentID, array('LocationID' => $locationID));
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function create($contentID) {
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