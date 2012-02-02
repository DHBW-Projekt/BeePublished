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
 * @description Controller to create and destroy associations between menus and categories
 */
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
    
    // put all associated and not associated categories to an array
    function index($menuName = null, $menuID = null) {
    	$categoriesUsedId = $this->FoodMenuMenusFoodMenuCategory->find('list', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID), 'fields' => array('food_menu_category_id')));
    	$categoriesUsed = $this->FoodMenuMenusFoodMenuCategory->find('all', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID)));
		$categoriesNotUsed = $this->FoodMenuCategory->find('all', array('conditions' => array('NOT' => array('FoodMenuCategory.id' => $categoriesUsedId), 'FoodMenuCategory.deleted' => null)));	
    	
		$categories['used'] = $categoriesUsed;
    	$categories['notUsed'] = $categoriesNotUsed;
    	$this->set('categories', $categories);
    	$this->set('menuID', $menuID);
    }
    
    // add a category to a menu
	function add($categoryID, $menuID) {
    	$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
	
		$data = array();
		$data['FoodMenuMenusFoodMenuCategory']['food_menu_menu_id'] = $menuID;
		$data['FoodMenuMenusFoodMenuCategory']['food_menu_category_id'] = $categoryID;
			if ($this->FoodMenuMenusFoodMenuCategory->save($data)) {
                $this->Session->setFlash(__d('food_menu', 'The category has been added.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The category couldn\'t be added.'));
                $this->redirect($this->referer());
            }//else
    }

    //delete association between a category and a menu
    function delete($categoryId, $menuId) {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$joinID = $this->FoodMenuMenusFoodMenuCategory->find('list', array('conditions' => array('food_menu_menu_id' => $menuId, 'food_menu_category_id' => $categoryId)));
    	
		if ($this->FoodMenuMenusFoodMenuCategory->delete($joinID)) {
			$this->Session->setFlash(__d('food_menu', 'The category has been removed from the menu.'));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__d('food_menu', 'The category couldn\'t be removed.'));
			$this->redirect($this->referer());
		}//else
    }
}
?>
