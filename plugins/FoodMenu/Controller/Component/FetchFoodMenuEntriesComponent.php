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
 * @description Component to fetch database datasets
 */
class FetchFoodMenuEntriesComponent extends Component
{
	// provide menus for view
	public function getMenus($controller, $selectedDate = null) {
		$menuItems = array();
		
    	$controller->loadModel('FoodMenu.FoodMenuMenu');
    	if(isset($selectedDate)) {
        	$allMenus = $controller->FoodMenuMenu->find('all', array('conditions' => array('valid_from <=' => $selectedDate, 'valid_until >=' => $selectedDate, 'deleted' => null)));
        	$menus = array();
        	foreach ($allMenus as $menu) {
        		$series_id = $menu['FoodMenuMenu']['food_menu_series_id'];
        		$weekdays = $this->getWeekdays($series_id); //get array with days when menu is availible
        		$weekday = date('N', strtotime($selectedDate)); //weekday for selected date (1=mon, 7=sun)
        		if ($weekdays[$weekday]=='1') {
        			$menus[] = $menu;
        		}
        	}
    	} else {
    		$date = date("Y-m-d"); 
    		$menus = $controller->FoodMenuMenu->find('all', array('conditions' => array('valid_from <=' => $date, 'valid_until >=' => $date, 'deleted' => null))); }
    	foreach($menus as $menu) {
        	$menuItems[] = $menu['FoodMenuMenu']; 
        }
        return $menuItems;
    }
    
	// provide categories for view
    public function getCategories($controller, $menuID)
    {
    	$categoryItems = array();
    	
    	$controller->loadModel('FoodMenu.FoodMenuMenusFoodMenuCategory');
        $controller->loadModel('FoodMenu.FoodMenuCategory');
        $categories = $controller->FoodMenuMenusFoodMenuCategory->find('all', array(
        															'conditions' => array(
        																'FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $menuID, 
        																'FoodMenuCategory.deleted' => null),
        															'order' => array(
        																'FoodMenuMenusFoodMenuCategory.id ASC')));
        if(!(isset($categories[0]))) return null;
        $categoryItems = array();
        $categoryItems['SelectedMenu'] = $categories[0]['FoodMenuMenu'];
        foreach($categories as $category) {
        	$categoryItems['FoodMenuCategory'][] = $category['FoodMenuCategory']; 
        }        
        return $categoryItems;
    }
	
	// provide entries for view
    public function getEntries($controller, $menuID, $categoryID)
    {
    	$entryItems = array();
    	
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
    
    //calc weekday by value in food_menu_series_id
    public function getWeekdays($seriesId) {
		$days = $seriesId;
		$daysAvailible = array();
		for ($i = 7; $i >= 1; $i--) {
			if ($days >= pow(2, ($i-1))) {
				$days = $days - pow(2, ($i-1));
				$daysAvailible[$i] = 1;
			}
			else $daysAvailible[$i] = 0;
		}
		return $daysAvailible;   	
    } // like a boss ;-)
    
}