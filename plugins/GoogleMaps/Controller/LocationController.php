<?php

class LocationController extends AppController {
		
	var $layout = 'overlay';
	
	public function admin($contentID){	
		$this->loadModel("ContentValues");
		$this->loadModel("GoogleMapsLocation");
		if (empty($this->data)) {
			$contentValue = $this->_getContentValue($contentID);
			if ($contentValue['ContentValues']['key'] == 'LocationID') {
				$this->data = $this->GoogleMapsLocation->find('first', array('conditions' => array('GoogleMapsLocation.id' => $contentValue['ContentValues']['value'])));
			}
		} else {
			$this->loadModel("ContentValues");
			$this->loadModel("GoogleMapsLocation");
			
			$locationID = $this->_checkIfLocationExists($this->data);
			
			if (!$locationID) {
				$location = $this->GoogleMapsLocation->save($this->data);
				$locationID = $location['GoogleMapsLocation']['id'];
			}
			
			$contentValue = $this->_getContentValue($contentID);
			$this->ContentValues->set($contentValue);
			$this->ContentValues->set('key', 'LocationID');
			$this->ContentValues->set('value', $locationID);
			$this->ContentValues->save();
		}
	}
	
	function _getContentValue($contentID) {
		return $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
	}
	
	function _checkIfLocationExists($location) {
		$this->loadModel("GoogleMapsLocation");
		$location = $this->GoogleMapsLocation->find(
			'first', 
			array('conditions' => array(
				'GoogleMapsLocation.street' => $location['GoogleMapsLocation']['street'],
		 		'GoogleMapsLocation.street_number'=> $location['GoogleMapsLocation']['street_number'],
		 		'GoogleMapsLocation.zip_code'=> $location['GoogleMapsLocation']['zip_code'],
		 		'GoogleMapsLocation.city'=> $location['GoogleMapsLocation']['city'],
		 		'GoogleMapsLocation.country'=> $location['GoogleMapsLocation']['country'],
		)));
		
		if (isset($location)) {
			return $location['GoogleMapsLocation']['id'];
		} else {
			return false;
		}
	}
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}