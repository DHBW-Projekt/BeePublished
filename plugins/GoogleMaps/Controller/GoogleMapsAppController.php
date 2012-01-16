<?php

class GoogleMapsAppController extends AppController {
	
	var $components = array('ContentValueManager');
	var $uses = array('GoogleMapsLocation');
	
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
			if (isset($this->params['data']['save'])) {
				$this->GoogleMapsLocation->save($this->data);
				$this->setLocation($contentID, $this->GoogleMapsLocation->id);
			} else {
				$this->redirect(array('action' => 'admin', $contentID));
			}
		}
	
		$this->set('contentID', $contentID);
	}
	
	function edit($contentID, $locationID) {
		$this->GoogleMapsLocation->id = $locationID;
		
		if (!empty($this->data)) {
			if (isset($this->params['data']['save'])) {
				$this->GoogleMapsLocation->save($this->data);
			}
			
			$this->redirect(array('action' => 'admin', $contentID));
		} else {
			$this->data = $this->GoogleMapsLocation->read();
			$this->set('contentID', $contentID);
			$this->set('locationID', $locationID);
		}
	}
	
	function beforeFilter() {
		$this->theme = $this->Config->getValue('active_template');
		$this->set('design',$this->Config->getValue('active_design'));
	}
}

