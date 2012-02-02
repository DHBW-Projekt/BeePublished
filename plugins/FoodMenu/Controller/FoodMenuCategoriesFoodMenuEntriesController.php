<?php

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
    
    function index($categoryName = null, $categoryID = null) {
    	$entriesUsedId = $this->FoodMenuCategoriesFoodMenuEntry->find('list', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID), 'fields' => array('food_menu_entry_id')));
    	$entriesUsed = $this->FoodMenuCategoriesFoodMenuEntry->find('all', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID)));
		$entriesNotUsed = $this->FoodMenuEntry->find('all', array('conditions' => array('NOT' => array('FoodMenuEntry.id' => $entriesUsedId), 'FoodMenuEntry.deleted' => null)));	
    	
		$entries['used'] = $entriesUsed;
    	$entries['notUsed'] = $entriesNotUsed;
    	$this->set('entries', $entries);
    	$this->set('categoryID', $categoryID);
    }
    
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
