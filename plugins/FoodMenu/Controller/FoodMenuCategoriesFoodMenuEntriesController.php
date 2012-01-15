<?php

class FoodMenuCategoriesFoodMenuEntriesController extends AppController {
	
	public $name = 'FoodMenuCategoriesFoodMenuEntries';
	public $uses = array('FoodMenu.FoodMenuCategoriesFoodMenuEntry', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';

	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
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
    
    function add($entryName, $entryID, $categoryID) {
	
		$data = array();
		$data['FoodMenuCategoriesFoodMenuEntry']['food_menu_category_id'] = $categoryID;
		$data['FoodMenuCategoriesFoodMenuEntry']['food_menu_entry_id'] = $entryID;
			if ($this->FoodMenuCategoriesFoodMenuEntry->save($data)) {
                $this->Session->setFlash(__('The entry has been added.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The entry couldn\'t be added.'));
                $this->redirect($this->referer());
            }//else
    }
    
    function delete($joinID) {
    		if ($this->FoodMenuCategoriesFoodMenuEntry->delete($joinID)) {
                $this->Session->setFlash(__('The entry has been removed from the category.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The entry couldn\'t be removed.'));
                $this->redirect($this->referer());
            }//else
    	
    }
}

?>
