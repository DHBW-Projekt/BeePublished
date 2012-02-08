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
 * @description Controller to create and destroy associations between categories and entries
 */
class FoodMenuCategoriesFoodMenuEntriesController extends FoodMenuAppController {
	
	public $name = 'FoodMenuCategoriesFoodMenuEntries';
	public $uses = array('FoodMenu.FoodMenuCategoriesFoodMenuEntry', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
    
    // put all associated and not associated entries to an array
    function index($categoryName = null, $categoryID = null) {
    	$entriesUsedId = $this->FoodMenuCategoriesFoodMenuEntry->find('list', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID), 'fields' => array('food_menu_entry_id')));
    	$entriesUsed = $this->FoodMenuCategoriesFoodMenuEntry->find('all', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID)));
		$entriesNotUsed = $this->FoodMenuEntry->find('all', array('conditions' => array('NOT' => array('FoodMenuEntry.id' => $entriesUsedId), 'FoodMenuEntry.deleted' => null)));	
    	
		$entries['used'] = $entriesUsed;
    	$entries['notUsed'] = $entriesNotUsed;
    	$this->set('entries', $entries);
    	$this->set('categoryID', $categoryID);
    }
    
    //add an entry to a category
	function add($entryID, $categoryID) {
    	$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
	
		$data = array();
		$data['FoodMenuCategoriesFoodMenuEntry']['food_menu_category_id'] = $categoryID;
		$data['FoodMenuCategoriesFoodMenuEntry']['food_menu_entry_id'] = $entryID;
			if ($this->FoodMenuCategoriesFoodMenuEntry->save($data)) {
                $this->Session->setFlash(__d('food_menu', 'The entry has been added.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The entry couldn\'t be added.'));
                $this->redirect($this->referer());
            }//else
    }

    // delete the association between an entry an a category
    function delete($entryId, $categoryId) {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$joinID = $this->FoodMenuCategoriesFoodMenuEntry->find('list', array('conditions' => array('food_menu_category_id' => $categoryId, 'food_menu_entry_id' => $entryId)));
    	
    		if ($this->FoodMenuCategoriesFoodMenuEntry->delete($joinID)) {
                $this->Session->setFlash(__d('food_menu', 'The entry has been removed from the category.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The entry couldn\'t be removed.'));
                $this->redirect($this->referer());
            }//else
    }
    
    
}

?>
