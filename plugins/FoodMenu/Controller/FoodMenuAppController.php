<?php

class FoodMenuAppController extends AppController {
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');


	function viewMenu() {
		$this->loadModel('FoodMenuMenu');
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuEntry');
		$this->FoodMenuMenu->bindModel(array('hasAndBelongsToMany' => array('FoodMenuCategory' => array('conditions'=>array('Category.ID'=>'*')))));

		
//		$menu = $this->FoodMenuMenu->find('all');
//		$category = $this->FoodMenuCategory->find('all');
//		$entries = $this->FoodMenuEntry->find('all');
		$menu = $this->FoodMenuMenu->find('all');
		$category = $this->FoodMenuCategory->find('all');
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('data', array($menu, $category, $entries));
		
		$this->render('/Elements/MenuLinks');
	}
	
	function showCategories() {
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuMenu');
		$this->FoodMenuMenu->bindModel(array('hasAndBelongsToMany' => array('FoodMenuCategory' => array())));

		$menu = $this->FoodMenuMenu->find('all');
		
		$this->render('/Elements/MenuLinks');
	}

}

