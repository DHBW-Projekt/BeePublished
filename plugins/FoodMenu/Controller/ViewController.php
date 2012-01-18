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
	
	 function addCategoriesToMenu() {
		// Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	if ($this->FoodMenuCategory->saveAll($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Kategorien hinzugef�gt");
            	$this->set('mode', null);
            	$this->redirect($this->referer());
            	//$this->render('/View/admin');
        	}
    	}
	    // If no form data, find the recipe to be edited
    	// and hand it to the view.
    	$menu = $this->FoodMenuMenu->findById($id);
    	$this->set('menu', $menu);
    	$this->set('mode', 'add');
    	
    	//Submit variables of admin method to make back-button work
    	$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
		
    	$this->render('/FoodMenuMenu/index');
	}
	
	function selectDate() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if(array_key_exists('datepicker', $data)) {
				$date = str_replace('/', '-', $this->request->data['datepicker']);
				
				if(!(array_key_exists('refererurl', $data))) {
					$refererurl = $this->referer();
					
					$regex = '/^\d{2}\-\d{2}\-(\d{2}|\d{4})$/'; //regex to check if there could be a date	
					
					if (substr($refererurl, -1, 1) != '/') {
						if (preg_match($regex, substr($refererurl, -10, 10))) {
							$refererurl = str_replace(substr($refererurl, -10, 10), '', $refererurl . '/view/');
						} else $refererurl = $refererurl . 'view/';
					} else {
						if (preg_match($regex, substr($refererurl, -11, 10))) {
							$refererurl = str_replace(substr($refererurl, -11, 11), '', $refererurl . '/view/');
						} else $refererurl = $refererurl . 'view/';
					}
					
				} else $refererurl = str_replace('#', '', $data['refererurl']); // replace # in url
        		
				if (condition) {
					;
				}
				
				if(substr($refererurl, -1, 1) != '/') { 
					$refererurl = $refererurl . '/';
				}
				
        		if($refererurl != '') {
        			$this->redirect($refererurl . $date);
        		}
        		
			}

		}
	}
}
?>