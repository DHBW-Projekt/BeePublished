<?php

class FoodMenuAppController extends AppController {
	
	public $name = 'FoodMenuApp';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	public $components = array('FoodMenu.View');
	var $helpers = array('Html', 'Form');
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
		$menus = $this->FoodMenuMenu->find('list');		
		//$categories = $this->FoodMenuMenu->find('all', array('conditions' => 'FoodMenuMenu.id = '.$selectedMenu.''));
		$categories = $this->FoodMenuMenu->findById($selectedMenu);
		
		$this->set('menus', $menus);
		$this->set('categories', $categories);
		//$this->redirect($this->referer());
		$this->render('/Elements/View');
	}
}