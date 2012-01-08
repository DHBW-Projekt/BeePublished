<?php

class FoodMenuAppController extends AppController {
	
	public $name = 'FoodMenuApp';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $helpers = array('Html', 'Form');
	var $layout = 'default';
	//var $autoLayout = false;
	//var $autoRender = false;	
	
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
		
		// Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$saveData = $this->request->data;
			$series_id = 0;
			$series_id = $saveData['FoodMenuMenu']['mo'] + $saveData['FoodMenuMenu']['tu'] + $saveData['FoodMenuMenu']['we'] + $saveData['FoodMenuMenu']['th'] + $saveData['FoodMenuMenu']['fr'] + $saveData['FoodMenuMenu']['sa'] + $saveData['FoodMenuMenu']['su'];
			$save = array('FoodMenuMenu' => array('id' => $saveData['FoodMenuMenu']['id'], 'name' => $saveData['FoodMenuMenu']['name'], 'valid_from' => $saveData['FoodMenuMenu']['valid_from'], 'valid_until' =>$saveData['FoodMenuMenu']['valid_until'], 'food_menu_series_id' => $series_id));
        	if ($this->FoodMenuMenu->save($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Speiseplan geändert");
            	$this->set('mode', null);
            	$this->redirect($this->referer());
            	//$this->render('/View/admin');
        	}
    	}
	    // If no form data, find the recipe to be edited
    	// and hand it to the view.
    	$menu = $this->FoodMenuMenu->findById($id);
    	$this->set('menu', $menu);
    	$this->set('mode', 'edit');
    	
    	//Submit variables of admin method to make back-button work
    	$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
		
    	$this->render('/View/admin');
    	//$this->redirect($this->referer());
		
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
		// Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	if ($this->FoodMenuCategory->save($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Kategorie geändert");
            	$this->set('mode', null);
            	$this->redirect($this->referer());
            	//$this->render('/View/admin');
        	}
    	}
	    // If no form data, find the recipe to be edited
    	// and hand it to the view.
    	$category = $this->FoodMenuCategory->findById($id);
    	$this->set('category', $category);
    	$this->set('mode', 'edit');
    	
    	//Submit variables of admin method to make back-button work
    	$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
		
    	$this->render('/View/admin');
    	//$this->redirect($this->referer());
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
		// Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	if ($this->FoodMenuEntry->save($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Kategorie geändert");
            	$this->set('mode', null);
            	$this->redirect($this->referer());
            	//$this->render('/View/admin');
        	}
    	}
	    // If no form data, find the recipe to be edited
    	// and hand it to the view.
    	$entry = $this->FoodMenuEntry->findById($id);
    	$this->set('entry', $entry);
    	$this->set('mode', 'edit');
    	
    	//Submit variables of admin method to make back-button work
    	$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
		$entries = $this->FoodMenuEntry->find('all');
		$this->set('entries', $entries);
		
    	$this->render('/View/admin');
    	//$this->redirect($this->referer());
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
	
	function deleteEntries() {
		if(array_key_exists('FoodMenuEntry', $this->request->data)) {
			$ids = array_keys($this->request->data['FoodMenuEntry']);
			echo print_r($ids);
			foreach ($ids as $id) {
					echo $id;
					$this->request->data = $this->FoodMenuEntry->read('deleted', $id);
					$this->request->data['FoodMenuEntry']['deleted'] = date("Y-m-d H:i:s");
					if($this->FoodMenuEntry->save($this->request->data)) {
						continue;
					}//if
					else {
						$this->Session->setFlash(__('Fehler beim Löschen.'));
						return;
					}	
			}
			$this->Session->setFlash(__('Die Einträge wurden entfernt.'));
			$this->redirect($this->referer());
		}
	}
	
	function deleteCategories() {
		if(array_key_exists('FoodMenuCategory', $this->request->data)) {
			$ids = array_keys($this->request->data['FoodMenuCategory']);
			echo print_r($ids);
			foreach ($ids as $id) {
					echo $id;
					$this->request->data = $this->FoodMenuCategory->read('deleted', $id);
					$this->request->data['FoodMenuCategory']['deleted'] = date("Y-m-d H:i:s");
					if($this->FoodMenuCategory->save($this->request->data)) {
						continue;
					}//if
					else {
						$this->Session->setFlash(__('Fehler beim Löschen.'));
						return;
					}	
			}
			$this->Session->setFlash(__('Die Kategorien wurden entfernt.'));
			$this->redirect($this->referer());
		}
	}
	
	function deleteMenus() {
		if(array_key_exists('FoodMenuMenu', $this->request->data)) {
			$ids = array_keys($this->request->data['FoodMenuMenu']);
			echo print_r($ids);
			foreach ($ids as $id) {
					echo $id;
					$this->request->data = $this->FoodMenuMenu->read('deleted', $id);
					$this->request->data['FoodMenuMenu']['deleted'] = date("Y-m-d H:i:s");
					if($this->FoodMenuMenu->save($this->request->data)) {
						continue;
					}//if
					else {
						$this->Session->setFlash(__('Fehler beim Löschen.'));
						return;
					}	
			}
			$this->Session->setFlash(__('Die Speisepläne wurden entfernt.'));
			$this->redirect($this->referer());
		}
	}
	function showCategories( $name = null, $id = null ) {
		
		$selectedMenu = $id; //Get ID of selected FoodMenu
				
		$categories = $this->FoodMenuMenu->find('all', array('conditions' => 'FoodMenuMenu.id = '.$selectedMenu.''));
		$data = array('FoodMenuMenu' => $categories);
		$this->set('data', $data);
		$this->layout = 'default';
		$this->render('/Elements/View');
		
		//$this->redirect($this->referer());
	}
	function addCategoriesToMenu() {
		
	}
}