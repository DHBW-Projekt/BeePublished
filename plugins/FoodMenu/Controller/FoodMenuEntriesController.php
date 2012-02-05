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
 * @author Benedikt Steffan
 * 
 * @description Controller to perform create, edit and delete of entries
 */
App::uses('Sanitize', 'Utility');
class FoodMenuEntriesController extends FoodMenuAppController {
	
	public $name = 'FoodMenuEntries';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry', 'FoodMenu.FoodMenuCategoriesFoodMenuEntry');
	var $layout = 'overlay';

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
    
    // put all entries into an array
    public function index() {
		$entries = $this->FoodMenuEntry->find('all', array('conditions' => array('deleted' => null)));
		$this->set('entries', $entries);	
	}

	// create a new entry
	function create() {
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
			if ($this->request->is('post') && isset($this->request->data['FoodMenuEntry'])) {
			$save = $this->request->data;
			$save['FoodMenuEntry']['price'] = str_replace(',', '.', $save['FoodMenuEntry']['price']);				
            if ($this->FoodMenuEntry->save(Sanitize::clean($save, array('encode' => false)))) {
                $this->Session->setFlash(__d('food_menu', 'The entry has been saved successfully.', array('class' => 'flash_success')));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The entry couldn\'t be saved.', array('class' => 'flash_failure')));
            }//else
        }//if
	}//create
	
	// edit an existing entry
	function edit($name = null, $id = null) {	
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		// Has any form data been POSTed?
    	if ($this->request->is('post') && isset($this->request->data['FoodMenuEntry'])) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	$save['FoodMenuEntry']['price'] = str_replace(',', '.', $save['FoodMenuEntry']['price']);
        	if ($this->FoodMenuEntry->save(Sanitize::clean($save, array('encode' => false)))) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash((__d('food_menu', 'The entry has been changed successfully', array('class' => 'flash_success'))));
            	$this->set('mode', 'edit');
            	$this->redirect($this->referer());
            	//$this->render('/View/admin');
        	}
    	}
	    // If no form data, find the recipe to be edited
    	// and hand it to the view.
    	$entry = $this->FoodMenuEntry->findById($id);
    	$this->set('entry', $entry);
    	$this->set('mode', 'edit');
    	
    	//Submit variables of admin method to make back-button work
    	$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
			
	}//edit

	//delete an entry (logically)
	function delete($name = null, $id = null) {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$this->FoodMenuEntry->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuEntry->read();
			$this->request->data['FoodMenuEntry']['deleted'] = date("Y-m-d H:i:s");
			$save['FoodMenuEntry'] = $this->request->data['FoodMenuEntry'];#
			
			//if deletion was successful, delete associations, too.
			if($this->FoodMenuEntry->save($save)) {
				$this->FoodMenuCategoriesFoodMenuEntry->deleteAll(array('FoodMenuCategoriesFoodMenuEntry.food_menu_entry_id' => $id), false);
				$this->Session->setFlash(__d('food_menu', 'The entry has been deleted.', array('class' => 'flash_success')));
				$this->redirect($this->referer());
			}//if
		}//if	
	}//delete
	
	//delete more than one entry at once
	function deleteMultiple() {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		if(array_key_exists('FoodMenuEntry', $this->request->data)) {
			$ids = array_keys($this->request->data['FoodMenuEntry']);
			foreach ($ids as $id) {
					$this->FoodMenuEntry->id = $id;
					$this->request->data = $this->FoodMenuEntry->read();
					$this->request->data['FoodMenuEntry']['deleted'] = date("Y-m-d H:i:s");
					$save['FoodMenuEntry'] = $this->request->data['FoodMenuEntry'];
					//if deletion was successful, delete associations, too.
					if($this->FoodMenuEntry->save($save)) {
						$this->FoodMenuCategoriesFoodMenuEntry->deleteAll(array('FoodMenuCategoriesFoodMenuEntry.food_menu_entry_id' => $id), false);
						continue;
					}//if
					else {
						$this->Session->setFlash(__d('food_menu', 'Errors occured during deleting.', array('class' => 'flash_failure')));
						$this->redirect($this->referer());
					}	
			}
			$this->Session->setFlash(__d('food_menu', 'The entries have been deleted.', array('class' => 'flash_success')));
			$this->redirect($this->referer());
		}
		else {
			$this->Session->setFlash(__d('food_menu', 'No entries were selected.', array('class' => 'flash_failure')));
			$this->redirect($this->referer());
		}
	}//deleteMultiple
}
?>