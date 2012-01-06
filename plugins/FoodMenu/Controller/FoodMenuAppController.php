<?php

class FoodMenuAppController extends AppController {
	
	public $name = 'FoodMenuApp';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $helpers = array('Html', 'Form');
	var $autoLayout = false;
	
	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }//beforeFilter

	function viewMenu() {
//		$this->loadModel('FoodMenuMenu');
//		$this->loadModel('FoodMenuCategory');
//		$this->loadModel('FoodMenuEntry');
//		$this->FoodMenuMenu->bindModel(array('hasAndBelongsToMany' => array('FoodMenuCategory' => array('conditions'=>array('Category.ID'=>'*')))));
//
//		$menus = $this->FoodMenuMenu->find('all');
//		$categories = $this->FoodMenuCategory->find('all');
//		$entries = $this->FoodMenuEntry->find('all');
//		$this->set('data', array($menus, $categories, $entries));
//		
//		$this->render('/Elements/MenuLinks');
	}//viewMenu

//	function showCategories( $name = null, $id = null ) {
//		
////		$selectedMenu = $id; //Get ID of selected FoodMenu
////		
////		$this->loadModel('FoodMenuMenu');
////		$this->loadModel('FoodMenuCategory');
////	
////		$categories = $this->FoodMenuCategory->query('SELECT Category.* FROM food_menu_categories AS Category
////				LEFT JOIN (food_menu_menus_food_menu_categories) 
////				ON (food_menu_menus_food_menu_categories.food_menu_category_id = Category.id)
////				WHERE food_menu_menus_food_menu_categories.food_menu_menu_id ='.$selectedMenu.'');
////		debug($categories,$showHtml=false, $showFrom=true);
////		$this->set('categories', $categories);
////		
////		//$this->redirect($this->referer());
////  		$this->render('/Elements/View');
//	}
	
	function showEntries() {
		$selectedCategory = $this->request->data['url']; //Get ID of selected FoodMenu
		
		$this->loadModel('FoodMenuCategory');
		$this->loadModel('FoodMenuEntry');
		
		$this->FoodMenuCategory->bindModel(array('hasAndBelongsToMany' => array('FoodMenuEntry' => array())));

		$entry = $this->FoodMenuEntry->find('all', array('conditions'=>array('Category.name'=>$selectedCategory)));
		
		$this->render('/Elements/MenuLinks');
	}//showEntries
	
	function addCategories() {
		
	}//addCategories
	
	function editMenu($name = null, $id = null) {
		$this->FoodMenuMenu->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->FoodMenuMenu->read();
    	} else {
        	if ($this->FoodMenuMenu->save($this->request->data)) {
            	$this->Session->setFlash('Die Speisekarte wurde geändert.');
            	$this->redirect(array($this->referer()));
        	} else {
            	$this->Session->setFlash('Die Speisekarte konnte nicht geändert werden.');
        	}//else
    	}//else
	}//editMenu
	
	function deleteMenu($name = null, $id = null) {
		$this->FoodMenuMenu->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuMenu->read('deleted', $id);
			$this->request->data['FoodMenuMenu']['deleted'] = date("Y-m-d H:i:s");
			if($this->FoodMenuMenu->save($this->request->data)) {
				$this->Session->setFlash(__('Der Speiseplan wurde entfernt.'));
				$this->redirect($this->referer());
			}//if
		}//if
	}//deleteMenu
	
	function addEntries() {
	}//addEntries
	
	function editCategory($name = null, $id = null) {
		$this->FoodMenuCategory->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->FoodMenuCategory->read();
    	} else {
        	if ($this->FoodMenuCategory->save($this->request->data)) {
            	$this->Session->setFlash('Die Kategorie wurde geändert.');
            	$this->redirect(array($this->referer()));
        	} else {
            	$this->Session->setFlash('Die Kategorie konnte nicht geändert werden.');
        	}//else
		}//else
	}//editCategory
	
	function deleteCategory($name = null, $id = null) {
		$this->FoodMenuCategory->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuCategory->read('deleted', $id);
			$this->request->data['FoodMenuCategory']['deleted'] = date("Y-m-d H:i:s");
			if($this->FoodMenuCategory->save($this->request->data)) {
				$this->Session->setFlash(__('Die Kategorie wurde entfernt.'));
				$this->redirect($this->referer());
			}//if
		}//if
	}//deleteCategory
	
	function editEntry($name = null, $id = null) {
		$this->FoodMenuEntry->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->FoodMenuEntry->read();
    	} else {
        	if ($this->FoodMenuEntry->save($this->request->data)) {
            	$this->Session->setFlash('Der Eintrag wurde geändert.');
            	$this->redirect(array($this->referer()));
        	} else {
            	$this->Session->setFlash('Der Eintrag konnte nicht geändert werden.');
        	}//else
	}//else
		
	}//editEntry
	
	function deleteEntry($name = null, $id = null) {
		$this->FoodMenuEntry->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuEntry->read('deleted', $id);
			$this->request->data['FoodMenuEntry']['deleted'] = date("Y-m-d H:i:s");
			if($this->FoodMenuEntry->save($this->request->data)) {
				$this->Session->setFlash(__('Der Speiseplan wurde entfernt.'));
				$this->redirect($this->referer());
			}//if
		}//if	
	}//deleteEntry
	
	function addMenu() {
		if ($this->request->is('post')) {
			
			$saveData = $this->request->data;
			$series_id = 0;
			$series_id = $saveData['FoodMenuMenu']['mo'] + $saveData['FoodMenuMenu']['tu'] + $saveData['FoodMenuMenu']['we'] + $saveData['FoodMenuMenu']['th'] + $saveData['FoodMenuMenu']['fr'] + $saveData['FoodMenuMenu']['sa'] + $saveData['FoodMenuMenu']['su'];
			$save = array('FoodMenuMenu' => array('name' => $saveData['FoodMenuMenu']['name'], 'valid_from' => $saveData['FoodMenuMenu']['valid_from'], 'valid_until' =>$saveData['FoodMenuMenu']['valid_until'], 'food_menu_series_id' => $series_id));
			
            if ($this->FoodMenuMenu->save($save)) {
                //$this->Session->setFlash(__('Der Speiseplan wurde gespeichert.'));
                $this->Session->setFlash('Der Speiseplan wurde gespeichert.');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('Der Speiseplan konnte nicht gespeichert werden.'));
            }//else
        }//if
	}//addMenu
	
	function addCategory() {
		if ($this->request->is('post')) {			
            if ($this->FoodMenuCategory->save($this->request->data)) {
                $this->Session->setFlash(__('Die Kategorie wurde gespeichert.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('Die Kategorie konnte nicht gespeichert werden.'));
            }//else
        }//if
	}//addCategory
	
	function addEntry() {
			if ($this->request->is('post')) {			
            if ($this->FoodMenuEntry->save($this->request->data)) {
                $this->Session->setFlash(__('Der Eintrag wurde gespeichert.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('Der Eintrag konnte nicht gespeichert werden.'));
            }//else
        }//if
	}//addEntry
}