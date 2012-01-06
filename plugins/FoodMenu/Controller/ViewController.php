<?php

class ViewController extends AppController {
	
	public $name = 'View';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $autoLayout = false;
	//var $autoRender = false;


	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }
    
    private function getAndSetData(){
		$menus = $this->FoodMenuMenu->find('all');
		$categories = $this->FoodMenuCategory->find('all');
		$entries = $this->FoodMenuEntry->find('all');
		array('FoodMenuMenu' => $menus, 'FoodMenuCategory' => $categories, 'FoodMenuEntry' => $entries);
		
		$this->set('menus', $menus);
		$this->set('categories', $categories);
		$this->set('entries', $entries);
		$this->set('data', $data);  
		}   

	public function admin( $contentID ) {
		$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
	}

	public function content( ) {
	
	}
	
	function showCategories( $name = null, $id = null ) {
		
		$selectedMenu = $id; //Get ID of selected FoodMenu	
		//$categories = $this->FoodMenuMenu->find('all');
		$categories = $this->FoodMenuCategory->query('SELECT Category.* FROM food_menu_categories AS Category
				LEFT JOIN (food_menu_menus_food_menu_categories) 
				ON (food_menu_menus_food_menu_categories.food_menu_category_id = Category.id)
				WHERE food_menu_menus_food_menu_categories.food_menu_menu_id ='.$selectedMenu.'');
		
		//debug($categories,$showHtml=false, $showFrom=true);
		$this->set('categories', $categories);
		debug($categories);
		$this->render($this->view, $this->layout);
		$this->redirect($this->referer());

	}
}
?>