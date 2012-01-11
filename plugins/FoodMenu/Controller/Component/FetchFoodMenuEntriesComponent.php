<?php

class FetchFoodMenuEntriesComponent extends Component
{
	public function getMenus($controller, $selectedDate = null) {
    	$controller->loadModel('FoodMenu.FoodMenuMenu');
    	if(isset($selectedDate)) {
        	$menus = $controller->FoodMenuMenu->find('all', array('conditions' => array('valid_from <=' => $selectedDate, 'valid_until >=' => $selectedDate)));
    	} else { $menus = $controller->FoodMenuMenu->find('all'); }
    	foreach($menus as $menu) {
        	$menuItems[] = $menu['FoodMenuMenu']; 
        }
        return $menuItems;
    }
    
    public function getCategories($controller, $menuID, $selectedDate = null)
    {
    	$controller->loadModel('FoodMenu.FoodMenuMenusFoodMenuCategory');
        $controller->loadModel('FoodMenu.FoodMenuCategory');
        $categories = $controller->FoodMenuMenusFoodMenuCategory->find('all', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID)));
        $categoryItems = array();
        $categoryItems['SelectedMenu'] = $categories[0]['FoodMenuMenu'];
        foreach($categories as $category) {
        	$categoryItems[] = $category['FoodMenuCategory']; 
        }        
        return $categoryItems;
    }
	
    public function getEntries($controller, $menuID, $categoryID, $selectedDate = null)
    {
    	$controller->loadModel('FoodMenu.FoodMenuCategoriesFoodMenuCategory');
        $controller->loadModel('FoodMenu.FoodMenuEntry');
        $entries = $controller->FoodMenuCategoriesFoodMenuEntry->find('all', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID)));
        return $entries;
    }
    
}