<?php

class FoodMenuCategoriesController extends AppController {
	
	public $name = 'FoodMenuCategories';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';

	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

	public function index() {
		$categories = $this->FoodMenuCategory->find('all');
		$this->set('categories', $categories);
	}//index
	
	function create() {
		if ($this->request->is('post')) {			
            if ($this->FoodMenuCategory->save($this->request->data)) {
                $this->Session->setFlash(__('Die Kategorie wurde gespeichert.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('Die Kategorie konnte nicht gespeichert werden.'));
            }//else
        }//if
	}//create
	
	function edit($name = null, $id = null) {	
		// Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	if ($this->FoodMenuCategory->save($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Kategorie geändert");
            	$this->set('mode', 'edit');
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
	}//edit
	
	function delete($name = null, $id = null) {
		$this->FoodMenuCategory->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuCategory->read('deleted', $id);
			$this->request->data['FoodMenuCategory']['deleted'] = date("Y-m-d H:i:s");
			if($this->FoodMenuCategory->save($this->request->data)) {
				$this->Session->setFlash(__('Die Kategorie wurde entfernt.'));
				$this->redirect($this->referer());
			}//if
		}//if
	}//delete
	
	function deleteMultiple() {
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
	
}
?>