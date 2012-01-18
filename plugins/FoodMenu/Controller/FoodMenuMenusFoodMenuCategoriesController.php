<?php

class FoodMenuMenusFoodMenuCategoriesController extends FoodMenuAppController {
	
	public $name = 'FoodMenuMenusFoodMenuCategories';
	public $uses = array('FoodMenu.FoodMenuMenusFoodMenuCategory', 'FoodMenu.FoodMenuCategory');
	var $layout = 'overlay';

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
    
    function index($menuName = null, $menuID = null) {
    	$categoriesUsedId = $this->FoodMenuMenusFoodMenuCategory->find('list', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID), 'fields' => array('food_menu_category_id')));
    	$categoriesUsed = $this->FoodMenuMenusFoodMenuCategory->find('all', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID)));
		$categoriesNotUsed = $this->FoodMenuCategory->find('all', array('conditions' => array('NOT' => array('FoodMenuCategory.id' => $categoriesUsedId), 'FoodMenuCategory.deleted' => null)));	
    	
		$categories['used'] = $categoriesUsed;
    	$categories['notUsed'] = $categoriesNotUsed;
    	$this->set('categories', $categories);
    	$this->set('menuID', $menuID);
    }
    
    function add($categoryName, $categoryID, $menuID) {
    	$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
	
		$data = array();
		$data['FoodMenuMenusFoodMenuCategory']['food_menu_menu_id'] = $menuID;
		$data['FoodMenuMenusFoodMenuCategory']['food_menu_category_id'] = $categoryID;
			if ($this->FoodMenuMenusFoodMenuCategory->save($data)) {
                $this->Session->setFlash(__('The category has been added.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The category couldn\'t be added.'));
                $this->redirect($this->referer());
            }//else
    }
    
    function delete($joinID) {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
    	if ($this->FoodMenuMenusFoodMenuCategory->delete($joinID)) {
			$this->Session->setFlash(__('The category has been removed from the menu.'));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The category couldn\'t be removed.'));
			$this->redirect($this->referer());
		}//else
    	
    }
}

?>
