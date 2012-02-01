<?php

class GoogleMapsAppController extends AppController {
	
	var $components = array('ContentValueManager');
	var $uses = array('GoogleMaps.GoogleMapsLocation', 'Plugin');
	
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
		$this->checkPermissions($contentID, "Set Location", $redirect = "admin");
		
		$contentValue['LocationID'] = $locationID;
		$this->ContentValueManager->saveContentValues($contentID, $contentValue);
		$this->Session->setFlash(__d('google_maps', 'Location is set.'));
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function remove($contentID, $locationID, $redirect = true) {
		$this->checkPermissions($contentID, "Delete Location", $redirect = "admin");
		
		$this->GoogleMapsLocation->delete($locationID);
		$this->ContentValueManager->removeContentValues($contentID, array('LocationID' => $locationID));
	
		if ($redirect){
			$this->Session->setFlash(__d('google_maps', 'Location deleted.'));
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	function removeSelected($contentID){
		$this->checkPermissions($contentID, "Delete Location", $redirect = "admin");
		
		$deleted = false;
		
		if (isset($this->data['selectedLocations']))
			foreach ($this->data['selectedLocations'] as $location => $selection) {
				if ($selection) {
					$this->remove($contentID, $location, false);
					$deleted = true;
				}
			}
		
		if ($deleted)
			$this->Session->setFlash(__d('google_maps', 'Locations deleted.'));
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	function create($contentID) {
		$this->checkPermissions($contentID, "Create Location", $redirect = "admin");
		
		//PROCESS cancle
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		pr($this->data['GoogleMapsLocation']); pr($this->params);
		if (isset($this->data['GoogleMapsLocation']) && isset($this->params['data']['save'])) {			
			if ($this->GoogleMapsLocation->save($this->data)) {
				$this->setLocation($contentID, $this->GoogleMapsLocation->id);
			} else {
				$this->Session->setFlash(__d('google_maps', 'Please fill out all mandatory fields.'), 'default', array(
					'class' => 'flash_failure'));
			}
		}
	
		$this->set('contentID', $contentID);
	}
	
	function edit($contentID, $locationID) {
		$this->checkPermissions($contentID, "Edit Location", $redirect = "admin");

		//PROCESS cancle
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		
		$this->GoogleMapsLocation->id = $locationID;
		$this->set('contentID', $contentID);
		$this->set('locationID', $locationID);
		
		if (isset($this->data['GoogleMapsLocation']) && isset($this->params['data']['save'])) {
			if ($this->GoogleMapsLocation->save($this->data)) {
				$this->Session->setFlash(__d('google_maps', 'Location saved.'));
				$this->redirect(array('action' => 'admin', $contentID));
			} else {
				$this->Session->setFlash(__d('google_maps', 'Please fill out all mandatory fields.'), 'default', array(
								'class' => 'flash_failure'));
			}
		} else {
			$this->data = $this->GoogleMapsLocation->read();
		}
	}
	
	private function checkPermissions($contentID, $permission, $redirect){
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, $permission);
		if(!$allowed) {
			$this->Session->setFlash(__d('google_maps', 'Permission denied.'), 'default', array(
										'class' => 'flash_failure'));
				
			$this->redirect(array('action' => $redirect, $contentID));
		}
	}
	
	protected function getPluginId(){
		$GoogleMaps = $this->Plugin->findByName($this->plugin);
		$pluginId = $GoogleMaps['Plugin']['id'];
		return $pluginId;
	}
}

