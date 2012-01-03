<?php

class FoodMenuAppController extends AppController {
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	
	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

	function viewMenu() {
		$this->loadModel('FoodMenuMenu');
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuEntry');
		$this->FoodMenuMenu->bindModel(array('hasAndBelongsToMany' => array('FoodMenuCategory' => array('conditions'=>array('Category.ID'=>'*')))));

		$menu = $this->FoodMenuMenu->find('all');
		$category = $this->FoodMenuCategory->find('all');
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('data', array($menu, $category, $entries));
		
		$this->render('/Elements/MenuLinks');
	}
	
	function showCategories() {
		
		$selectedMenu = $_POST[]; //Get ID of selected FoodMenu
		
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuMenu');
		$this->FoodMenuMenu->bindModel(array('hasAndBelongsToMany' => array('FoodMenuCategory' => array())));

		$menu = $this->FoodMenuMenu->find('all', array('conditions'=>array('Menu.name'=>$selectedMenu)));
		
		$this->render('/Elements/MenuLinks');
	}
	
	function showEntries() {
		
		$selectedCategory = $_POST[]; //Get ID of selected FoodMenu
		
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuEntry');
		
		$this->FoodMenuCategory->bindModel(array('hasAndBelongsToMany' => array('FoodMenuEntry' => array())));

		$entry = $this->FoodMenuEntry->find('all', array('conditions'=>array('Category.name'=>$selectedCategory)));
		
		$this->render('/Elements/MenuLinks');
	}

}