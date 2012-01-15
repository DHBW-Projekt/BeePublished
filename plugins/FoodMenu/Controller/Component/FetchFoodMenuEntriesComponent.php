<?php

class FetchFoodMenuEntriesComponent extends Component
{
	public function getMenus($controller, $selectedDate = null) {
    	$controller->loadModel('FoodMenu.FoodMenuMenu');
    	if(isset($selectedDate)) {
        	$menus = $controller->FoodMenuMenu->find('all', array('conditions' => array('valid_from <=' => $selectedDate, 'valid_until >=' => $selectedDate, 'deleted' => null)));
    	} else { $menus = $controller->FoodMenuMenu->find('all', array('conditions' => array('deleted' => null))); }
    	foreach($menus as $menu) {
        	$menuItems[] = $menu['FoodMenuMenu']; 
        }
        return $menuItems;
    }
    
    public function getCategories($controller, $menuID)
    {
    	$controller->loadModel('FoodMenu.FoodMenuMenusFoodMenuCategory');
        $controller->loadModel('FoodMenu.FoodMenuCategory');
        $categories = $controller->FoodMenuMenusFoodMenuCategory->find('all', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID, 'FoodMenuCategory.deleted' => null)));
        if(!(isset($categories[0]))) return null;
        $categoryItems = array();
        $categoryItems['SelectedMenu'] = $categories[0]['FoodMenuMenu'];
        foreach($categories as $category) {
        	$categoryItems['FoodMenuCategory'][] = $category['FoodMenuCategory']; 
        }        
        return $categoryItems;
    }
	
    public function getEntries($controller, $menuID, $categoryID)
    {
    	$controller->loadModel('FoodMenu.FoodMenuCategoriesFoodMenuEntry');
        $controller->loadModel('FoodMenu.FoodMenuEntry');
        $entries = $controller->FoodMenuCategoriesFoodMenuEntry->find('all', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID, 'FoodMenuEntry.deleted' => null)));
        if(!(isset($entries[0]))) return null;
        $entryItems = array();
        $entryItems['SelectedCategory'] = $entries[0]['FoodMenuCategory'];
        foreach($entries as $entry) {
        	$entryItems['FoodMenuEntry'][] = $entry['FoodMenuEntry'];
        }
        return $entryItems;
    }
    
}