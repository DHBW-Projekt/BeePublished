<?php

class FoodMenuMenuController extends AppController {
	
	public $name = 'FoodMenuMenu';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry');
	var $layout = 'overlay';

	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

	public function index() {
		$menus = $this->FoodMenuMenu->find('all');
		$this->set('menus', $menus);	
	}
	
	function create() {
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
	}//create
	
	function edit($name = null, $id = null) {
		
		//Has any form data been POSTed?
    	if ($this->request->is('post')) {
        	// If the form data can be validated and saved...
        	$saveData = $this->request->data;
			$series_id = 0;
			$series_id = $saveData['FoodMenuMenu']['mo'] + $saveData['FoodMenuMenu']['tu'] + $saveData['FoodMenuMenu']['we'] + $saveData['FoodMenuMenu']['th'] + $saveData['FoodMenuMenu']['fr'] + $saveData['FoodMenuMenu']['sa'] + $saveData['FoodMenuMenu']['su'];
			$save = array('FoodMenuMenu' => array('id' => $saveData['FoodMenuMenu']['id'], 'name' => $saveData['FoodMenuMenu']['name'], 'valid_from' => $saveData['FoodMenuMenu']['valid_from'], 'valid_until' =>$saveData['FoodMenuMenu']['valid_until'], 'food_menu_series_id' => $series_id));
        	if ($this->FoodMenuMenu->save($save)) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash("Speiseplan geändert");
            	$this->set('mode', 'edit');
            	$this->redirect($this->referer());
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
			
	}//edit
	
	function delete($name = null, $id = null) {
		$this->FoodMenuMenu->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuMenu->read('deleted', $id);
			$this->request->data['FoodMenuMenu']['deleted'] = date("Y-m-d H:i:s");
			if($this->FoodMenuMenu->save($this->request->data)) {
				$this->Session->setFlash(__('Der Speiseplan wurde entfernt.'));
				$this->redirect($this->referer());
			}//if
		}//if
	}//delete
	
	function deleteMultiple() {
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
	}//deleteMultiple
}
?>