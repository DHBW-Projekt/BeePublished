<?php

class FoodMenuAppController extends AppController {
	
	public $name = 'FoodMenuApp';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	public $components = array('FoodMenu.View');
	var $helpers = array('Html', 'Form', 'Number');
	//var $layout = 'default';
	var $autoLayout = true;
	var $autoRender = true;	
	
	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }//beforeFilter

	
//	function showEntries() {
//		$selectedCategory = $this->request->data['url']; //Get ID of selected FoodMenu
//		
//		$this->loadModel('FoodMenuCategory');
//		$this->loadModel('FoodMenuEntry');
//		
//		$this->FoodMenuCategory->bindModel(array('hasAndBelongsToMany' => array('FoodMenuEntry' => array())));
//
//		$entry = $this->FoodMenuEntry->find('all', array('conditions'=>array('Category.name'=>$selectedCategory)));
//		
//		$this->render('/Elements/MenuLinks');
//	}//showEntries
	
	
	function showCategories( $name = null, $id = null ) {
		
		$selectedMenu = $id; //Get ID of selected FoodMenu
		$categoryIDs = $this->FoodMenuMenu->findById($id);
		
		$returnData = null;
		foreach ($categoryIDs['FoodMenuMenusFoodMenuCategory'] as $categoryID) {
			$entryIDs = $this->FoodMenuCategory->findById($categoryID['ID']);
			//$returnData['Category']  = $returnData['Category'] + $entryIDs['FoodMenuCategory']['name'];
			foreach ($entryIDs['FoodMenuCategoriesFoodMenuEntry'] as $entryID) {
				$returnData['Category'] = $entryID['name'];
				$name = $this->FoodMenuEntry->findById($entryID['ID']);
				$returnData['Category'][$entryID['name']] = $returnData['Category'][$entryID['name']] + $name['FoodMenuEntry']['name'];
			}
		}
		debug($returnData);
//	   $categories = $this->FoodMenuMenu->query('SELECT DISTINCT FoodMenuCategory.name, FoodMenuEntry.* FROM food_menu_categories AS FoodMenuCategory
//													JOIN (food_menu_menus_food_menu_categories AS FoodMenuMenusFoodMenuCategory) ON (FoodMenuMenusFoodMenuCategory.food_menu_category_id = FoodMenuCategory.id)
//													JOIN (food_menu_menus AS FoodMenuMenu) ON (FoodMenuMenu.id = FoodMenuMenusFoodMenuCategory.food_menu_menu_id)
//													JOIN (food_menu_categories_food_menu_entries AS FoodMenuCategoriesFoodMenuEntries) ON (FoodMenuCategoriesFoodMenuEntries.food_menu_category_id = FoodMenuCategory.id)
//													JOIN (food_menu_entries AS FoodMenuEntry) ON (FoodMenuEntry.id = FoodMenuCategoriesFoodMenuEntries.food_menu_entry_id)
//													WHERE FoodMenuMenu.id = '.$selectedMenu.'');
		//$categories = $this->FoodMenuMenu->findById($selectedMenu);
		
		$this->set('menuName', $name);
		$this->set('menuEntries', $categories);
		//$this->redirect($this->referer());
		$this->render('/View/ShowCategories', 'default');
	}
}