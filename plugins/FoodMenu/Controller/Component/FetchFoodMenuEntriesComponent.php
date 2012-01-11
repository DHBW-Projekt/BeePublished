<?php

class FetchFoodMenuEntriesComponent extends Component
{
	public function getMenus($controller, $selectedDate = null) {
    	$controller->loadModel('FoodMenu.FoodMenuMenu');
    	if(isset($selectedDate)) {
        	$menus = $controller->FoodMenuMenu->find('all', array('conditions' => array('valid_from <=' => $selectedDate, 'valid_until >=' => $selectedDate),));
    	} else { $menus = $controller->FoodMenuMenu->find('all'); }
        return $menus;
    }
    
    public function getCategories($controller, $menuID)
    {
        $controller->loadModel('FoodMenu.FoodMenuCategory');
        $categories = $controller->FoodMenuCategory->find('all', array('conditions' => array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID)));
        $sortedCategories = array();
        foreach ($categories as $category) {
            $sortedCategories[$category['FoodMenuCategory']][] = $category['FoodMenuCategory'];
        }
        return $sortedCategories;
    }
	
    public function getEntries($controller, $categoryID)
    {
        $controller->loadModel('FoodMenu.FoodMenuEntry');
        $entries = $controller->FoodMenuEntry->find('all', array('conditions' => array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $categoryID)));
        $sortedEntries = array();
        foreach ($entries as $entry) {
            $sortedEntries[$entry['FoodMenuEntry']][] = $entry['FoodMenuEntry'];
        }
        return $sortedEntries;
    }
    
}