<?php

class ViewController extends AppController {
	
	public $name = 'View';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';
	var $autoRender = false;

	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

	public function admin( $contentID ) {
		$menus = $this->FoodMenuMenu->find('all');
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
            	$this->Session->setFlash("Kategorien hinzugefügt");
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
//		if ($this->request->is('post')) {
//        	$date = $this->request->data;
//        	$suffix = substr (strrchr ($date['refererurl'], $this->referer()), 1);
//        	$this->referer($date['refererurl'] . $date['datepicker'] . $suffix);
//		}
	}
}
?>