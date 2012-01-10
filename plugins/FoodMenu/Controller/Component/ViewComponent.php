<?php
class ViewComponent extends Component {
	public $components = array('FoodMenu.FetchFoodMenuEntries');
	
	public function getData($controller, $params, $url, $id)	{
		debug($params);
		debug($url);
 		$data = array();
		if (sizeof($url) != 0) {
            switch ($url[0]) {
                case 'menu':
                    $data['Page'] = 'View';
                    $data['Action'] = 'showCategories';
                    if (array_key_exists(2, $url)) {
                    	//check if there is a proper menuID
                    	$mID = $url[2];
                    	if(is_int($mID)) $menuId = $mID;
                    }
                    break;
                case 'category':
                    $data['Page'] = 'View';
                    $data['Action'] = 'showEntries';
                    break;
                default:
                    $data['Page'] = 'View';
        	        $data['Action'] = 'showMenus';
        	        break;
            }
        } else {
        	$data['Page'] = 'View';
        	$data['Action'] = 'showMenus';
        	}
        debug($data);
        switch ($data['Page']) {
            case 'View':
            	if(isset($data['datepicker'])) {
            		$timestamp = strtotime($data['datepicker']);
                	$selectedDate = date('Y-m-d', $timestamp);
            	}              
                break;
//            case 'showCategories':
//                $startDate = date('Y-m-d', $data['StartTime']);
//                $menuId = $data['FoodMenuMenu']['id'];
//                break;
        }
        switch ($data['Action']) {
        	case 'showMenus':
		        if(!(isset($selectedDate))) {
//		        	$selectedDate = date('Y-m-d');
					$data['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller);
		        } else { $data['FoodMenuMenu'] = $this->FetchFoodMenuEntries->getMenus($controller, $selectedDate); }
                break;
            case 'showCategories':
            	if(isset($data['datepicker'])) {
            		$data['FoodMenuCategory'] = $this->FetchFoodMenuEntries->getCategories($controller, $menuId);
            	}              
                break;
            case 'showEntries':
                $startDate = date('Y-m-d', $data['StartTime']);
                $menuId = $data['FoodMenuMenu']['id'];
                break;
        }
        return $data;
	}
	
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}