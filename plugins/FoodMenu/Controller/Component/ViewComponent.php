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
 * @description Componet to set data for user view
 */
class ViewComponent extends Component {
	public $components = array('FoodMenu.FetchFoodMenuEntries');
	
	//set Data for view	
	public function getData($controller, $params, $url, $id)	{
		$controller->helpers[] = 'Number';
		
		/*   $url
		 *     [0] => 'menu'
    		   [1] => name of the menu
    		   [2] => id of the menu
               [3] => 'category'
               [4] => name of the category
               [5] => id of the category
               
               + last index is date
		 * 
		 */
 		$data = array();
 		$regex = '/^\d{2}\-\d{2}\-(\d{2}|\d{4})$/'; //regex to check if there could be a date
 		
		if (sizeof($url) != 0) {
			$arrayID = sizeof($url);
			$possibleDate = $url[$arrayID-1];
						
			if (preg_match($regex, $possibleDate))  {				
				if(sizeof($url)==1) {
					$data['Page'] = 'View';
        	    	$data['Action'] = 'showMenus';
				}//default values
				
				//change date format to yyyy-mm-dd
				$selectedDate = split('-', $possibleDate);
				$selectedDate = $selectedDate[2] . '-' . $selectedDate[0] . '-' .$selectedDate[1];

			}

            if ($url[0] == 'menu') {
                    $data['Page'] = 'View';
                    $data['Action'] = 'showCategories';
                    if (array_key_exists(2, $url)) {
                    	//check if there is a proper menuID
                    	$mID = $url[2];
                    	if(is_numeric($mID)) $menuId = $mID;
                    }
                    if(sizeof($url)>3) {
                    	if (array_key_exists(5, $url)) {
                    		if($url[3]=='category') {
                    			$data['Page'] = 'View';
                    			$data['Action'] = 'showEntries';
                    			$cID = $url[5];
                    			if(is_numeric($cID)) $categoryId = $cID;
                    		}
                    	}
                    }
            }

        } else {
        	$data['Page'] = 'View';
        	$data['Action'] = 'showMenus';
        	// default values
        }
		// in switch: decide what the user requested
		// in cases: decide whether if a date was selected or not + create the output data for view
        switch ($data['Action']) {
        	case 'showMenus':
		        if(!(isset($selectedDate))) {
					$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller);
		        } else {
		        	$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller, $selectedDate); 
		        }
                break;
            case 'showCategories':
            	if(!(isset($selectedDate))) {
            		$categories = $this->FetchFoodMenuEntries->getCategories($controller, $menuId);
            		$data['show']['FoodMenuCategory'] =  $categories['FoodMenuCategory'];
            		$data['show']['SelectedMenu'] = $categories['SelectedMenu'];
            		$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller);
            	} else {
            		$categories = $this->FetchFoodMenuEntries->getCategories($controller, $menuId);
            		$data['show']['FoodMenuCategory'] =  $categories['FoodMenuCategory'];
            		$data['show']['SelectedMenu'] = $categories['SelectedMenu'];
            		$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller, $selectedDate);
            		}
                break;
            case 'showEntries':
            	if(!(isset($selectedDate))) {
            		$entries = $this->FetchFoodMenuEntries->getEntries($controller, $menuId, $categoryId);
            		$data['show']['FoodMenuEntry'] = $entries['FoodMenuEntry'];
            		$data['show']['SelectedCategory'] = $entries['SelectedCategory'];
            		$categories = $this->FetchFoodMenuEntries->getCategories($controller, $menuId);
            		$data['show']['FoodMenuCategory'] =  $categories['FoodMenuCategory'];
            		$data['show']['SelectedMenu'] = $categories['SelectedMenu'];
            		$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller);
            	} else {
            		$entries = $this->FetchFoodMenuEntries->getEntries($controller, $menuId, $categoryId);
            		$data['show']['FoodMenuEntry'] = $entries['FoodMenuEntry'];
            		$data['show']['SelectedCategory'] = $entries['SelectedCategory'];
            		$categories = $this->FetchFoodMenuEntries->getCategories($controller, $menuId);
            		$data['show']['FoodMenuCategory'] =  $categories['FoodMenuCategory'];
            		$data['show']['SelectedMenu'] = $categories['SelectedMenu'];
            		$data['show']['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller, $selectedDate);
            		}
            	break;
        }
        if(sizeof($url)>0) {
        	if (isset($selectedDate)) {
        		$selectedDate = split('-', $selectedDate);
        		$selectedDate = $selectedDate[1] . '/' . $selectedDate[2] . '/' .$selectedDate[0];
        		
        		// change the date format again
        	} else $selectedDate = '';
        } else $selectedDate = '';
        
        //set selected date to view in the users input field
        $controller->set('selectedDate', $selectedDate);
        //set webroot for js-files
        $controller->set('webroot', $controller->webroot);
        return $data;
	}
}