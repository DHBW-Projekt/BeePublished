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
* @author Patrick Zamzow
*
* @description Google Maps core functionality
*/
class GoogleMapsAppController extends AppController {
	
	var $components = array('ContentValueManager');
	var $uses = array('GoogleMaps.GoogleMapsLocation', 'Plugin');
	
	/**
	 * Show admin overlay start page
	 * @param $contentID
	 */
	public function admin($contentID){
		//get all content values 
		$contentValue = $this->ContentValueManager->getContentValues($contentID);
		
		//get current location
		if (isset($contentValue['LocationID'])) {
			$currentLocation = $this->GoogleMapsLocation->findById($contentValue['LocationID']);
		} else {
			$currentLocation = null;
		}
		
		//set view variables
		$this->set('locations', $this->GoogleMapsLocation->find('all'));
		$this->set('currentLocation', $currentLocation);
		$this->set('contentID', $contentID);
	}
	
	/**
	 * Set location and redirect to admin view
	 * @param $contentID
	 * @param $locationID
	 */
	function setLocation($contentID, $locationID) {
		//check permissions
		$this->checkPermissions($contentID, "Set Location", $redirect = "admin");
		
		//save new content values
		$contentValue['LocationID'] = $locationID;
		$this->ContentValueManager->saveContentValues($contentID, $contentValue);
		
		//flash success
		$this->Session->setFlash(__d('google_maps', 'Location is set.'));
		
		//show admin page
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	/**
	 * Remove location from database
	 * @param $contentID
	 * @param $locationID
	 * @param $redirect
	 */
	function remove($contentID, $locationID, $redirect = true) {
		//check permissions
		$this->checkPermissions($contentID, "Delete Location", $redirect = "admin");
		
		//remove location and content values
		$this->GoogleMapsLocation->delete($locationID);
		$this->ContentValueManager->removeContentValues($contentID, array('LocationID' => $locationID));
		
		//check redirect and flash success
		if ($redirect){
			$this->Session->setFlash(__d('google_maps', 'Location deleted.'));
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	/**
	 * Remove selected locations
	 * @param $contentID
	 */
	function removeSelected($contentID){
		//check permissions
		$this->checkPermissions($contentID, "Delete Location", $redirect = "admin");
		
		//flag if location is deleted
		$deleted = false;
		
		//call remove function for each selected location
		if (isset($this->data['selectedLocations']))
			foreach ($this->data['selectedLocations'] as $location => $selection) {
				if ($selection) {
					$this->remove($contentID, $location, false);
					$deleted = true;
				}
			}
		
		//if one location is deleted set flash
		if ($deleted)
			$this->Session->setFlash(__d('google_maps', 'Locations deleted.'));
		
		//redirect
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	/**
	 * Create new location
	 * @param $contentID
	 */
	function create($contentID) {
		//check permissions
		$this->checkPermissions($contentID, "Create Location", $redirect = "admin");
		
		//PROCESS cancel
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		
		//PROCESS save
		if (isset($this->data['GoogleMapsLocation']) && isset($this->params['data']['save'])) {			
			if ($this->GoogleMapsLocation->save($this->data)) {
				$this->setLocation($contentID, $this->GoogleMapsLocation->id);
			} else {
				$this->Session->setFlash(__d('google_maps', 'Please fill out all mandatory fields.'), 'default', array(
					'class' => 'flash_failure'));
			}
		}
		
		//set view variables
		$this->set('contentID', $contentID);
	}
	
	/**
	 * Edit location
	 * @param $contentID
	 * @param $locationID
	 */
	function edit($contentID, $locationID) {
		//check permissions
		$this->checkPermissions($contentID, "Edit Location", $redirect = "admin");

		//PROCESS cancel
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		
		//set location id
		$this->GoogleMapsLocation->id = $locationID;
		
		//set view variables
		$this->set('contentID', $contentID);
		$this->set('locationID', $locationID);
		
		//PROCESS save
		if (isset($this->data['GoogleMapsLocation']) && isset($this->params['data']['save'])) {
			if ($this->GoogleMapsLocation->save($this->data)) {
				$this->Session->setFlash(__d('google_maps', 'Location saved.'));
				$this->redirect(array('action' => 'admin', $contentID));
			} else {
				$this->Session->setFlash(__d('google_maps', 'Please fill out all mandatory fields.'), 'default', array(
								'class' => 'flash_failure'));
			}
		} else {
			//get old data
			$this->data = $this->GoogleMapsLocation->read();
		}
	}
	
	/**
	 * Check permissions and redirect
	 * @param $contentID
	 * @param $permission
	 * @param $redirect
	 */
	private function checkPermissions($contentID, $permission, $redirect){
		//get plugin id
		$pluginId = $this->getPluginId();
		
		//check permissions
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, $permission);
		if(!$allowed) {
			//set flash if action is not allowed
			$this->Session->setFlash(__d('google_maps', 'Permission denied.'), 'default', array(
										'class' => 'flash_failure'));
			
			//redirect
			$this->redirect(array('action' => $redirect, $contentID));
		}
	}
	
	/**
	 * Get plugin id
	 * @return $pluginId
	 */
	protected function getPluginId(){
		$GoogleMaps = $this->Plugin->findByName($this->plugin);
		$pluginId = $GoogleMaps['Plugin']['id'];
		return $pluginId;
	}
}

