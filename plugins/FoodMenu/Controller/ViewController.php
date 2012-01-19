<?php

class ViewController extends FoodMenuAppController {
	
	public $name = 'View';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';
	var $autoRender = false;

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }

	public function admin( $contentID ) {
		$menus = $this->FoodMenuMenu->find('all', array('order' => array('valid_until ASC')));
		$this->set('menus', $menus);
		$this->render('/FoodMenuMenus/index');
	}
	
//	 function addCategoriesToMenu() {
//		// Has any form data been POSTed?
//    	if ($this->request->is('post')) {
//        	// If the form data can be validated and saved...
//        	$save = $this->request->data;
//        	if ($this->FoodMenuCategory->saveAll($save)) {
//            	// Set a session flash message and redirect.
//            	$this->Session->setFlash("Kategorien hinzugefügt");
//            	$this->set('mode', null);
//            	$this->redirect($this->referer());
//            	//$this->render('/View/admin');
//        	}
//    	}
//	    // If no form data, find the recipe to be edited
//    	// and hand it to the view.
//    	$menu = $this->FoodMenuMenu->findById($id);
//    	$this->set('menu', $menu);
//    	$this->set('mode', 'add');
//    	
//    	//Submit variables of admin method to make back-button work
//    	$menus = $this->FoodMenuMenu->find('all');
//		$this->set('menus', $menus);
//		$categories = $this->FoodMenuCategory->find('all');
//		$this->set('categories', $categories);
//		$entries = $this->FoodMenuEntry->find('all');
//		$this->set('entries', $entries);
//		
//    	$this->render('/FoodMenuMenu/index');
//	}
	
	function selectDate() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
			
			if(array_key_exists('datepicker', $data)) {
				$date = str_replace('/', '-', $this->request->data['datepicker']); //format datetime
				
				/* Check if a valid date was entered */
				$dateArray = explode('-', $date);
				if(checkdate($dateArray[0], $dateArray[1], $dateArray[2])) {
					
					//Get the referer Url
					$refererurl = $this->referer();
					
					//remove last '/' from URL					
					if (substr($refererurl, -1, 1) == '/') { 
						$refererurl = substr($refererurl, 0, -1); 
					}
					
					//replace http and put into array seperated by '/'
					$refererArray = explode('/', str_replace('http://', '', $refererurl));
					
					//get the last 'view' to get the element where the url starts
					for($i = (sizeof($refererArray)-1); $i >= 0; $i--) {
						if($refererArray[$i] == 'view') {
							$index = $i; //now we have the array index with the last /view/ of the url
						}
					}
					
					//regex to check if there was already a date entered
					$regex = '/^\d{2}\-\d{2}\-(\d{2}|\d{4})$/';
					
					//initialization of prefix and suffix
					$prefix = array();
					$suffix = array();
					//if 'view' was found in the url
					if(isset($index)) {
						$prefix = array_slice($refererArray, 0, $index);
						array_unshift($prefix, 'http:/');
						
						$suffix = array_slice($refererArray, $index);
						if(sizeof($suffix)>=8) {
							if(preg_match($regex, $suffix['7'])) {
								$suffix = array_slice($suffix, 0, 7);
								//category is loaded 
							}
						} // now we have everything from /view/ to ... in an array
						
						elseif(sizeof($suffix)>=5) {
							if(preg_match($regex, $suffix['4'])) {
								$suffix = array_slice($suffix, 0, 4);
								//menu is already loaded
							}
						}
						
						elseif(sizeof($suffix)>=2) {
							if(preg_match($regex, $suffix['1'])) {
								$suffix = array_slice($suffix, 0, 1);
								//whether menu nor category is loaded, but date
							}
						}
					}//if isset($index)
					else {
						$this->redirect($refererurl . '/view/' . $date);
					}
				} else {
					$this->redirect($this->referer());
				}
				
        		if((sizeof($prefix)>0) && (sizeof($suffix)>0) && $date != '') {
        			$prefix = implode('/', $prefix);
        			$suffix = implode('/', $suffix);
        			$this->redirect($prefix . '/' . $suffix . '/' . $date);
        		}
        		
			}

		}
	}
}
?>