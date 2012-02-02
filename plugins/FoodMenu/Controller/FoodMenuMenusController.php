<?php
App::uses('Sanitize', 'Utility');
class FoodMenuMenusController extends FoodMenuAppController {
	
	public $name = 'FoodMenuMenus';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry', 'FoodMenu.FoodMenuMenusFoodMenuCategory');
	var $layout = 'overlay';

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }

	public function index() {
		$menus = $this->FoodMenuMenu->find('all', array('order' => array('valid_until ASC'), 'conditions' => array('deleted' => null)));
		$this->set('menus', $menus);	
	}
	
	function create() {
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
		if ($this->request->is('post') && isset($this->request->data['FoodMenuMenu'])) {
			
			$saveData = $this->request->data;
			$series_id = 0;
			$series_id = $saveData['FoodMenuMenu']['mo'] + $saveData['FoodMenuMenu']['tu'] + $saveData['FoodMenuMenu']['we'] + $saveData['FoodMenuMenu']['th'] + $saveData['FoodMenuMenu']['fr'] + $saveData['FoodMenuMenu']['sa'] + $saveData['FoodMenuMenu']['su'];
			$save = array('FoodMenuMenu' => array('name' => $saveData['FoodMenuMenu']['name'], 'valid_from' => $saveData['FoodMenuMenu']['valid_from'], 'valid_until' =>$saveData['FoodMenuMenu']['valid_until'], 'food_menu_series_id' => $series_id));
			
            if ($this->FoodMenuMenu->save(Sanitize::clean($save, array('encode' => false)))) {
                $this->Session->setFlash(__d('food_menu', 'The menu was saved successfully.', array('class' => 'flash_success')));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The menu couldn\'t be saved', array('class' => 'flash_failure')));
            }//else
        }//if
	}//create
	
	function edit($name = null, $id = null) {
		
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		
		//Has any form data been POSTed?
    	if ($this->request->is('post') && isset($this->request->data['FoodMenuMenu'])) {
        	// If the form data can be validated and saved...
        	$saveData = $this->request->data;
			$series_id = 0;
			$series_id = $saveData['FoodMenuMenu']['mo'] + $saveData['FoodMenuMenu']['tu'] + $saveData['FoodMenuMenu']['we'] + $saveData['FoodMenuMenu']['th'] + $saveData['FoodMenuMenu']['fr'] + $saveData['FoodMenuMenu']['sa'] + $saveData['FoodMenuMenu']['su'];
			$save = array('FoodMenuMenu' => array('id' => $saveData['FoodMenuMenu']['id'], 'name' => $saveData['FoodMenuMenu']['name'], 'valid_from' => $saveData['FoodMenuMenu']['valid_from'], 'valid_until' =>$saveData['FoodMenuMenu']['valid_until'], 'food_menu_series_id' => $series_id));
        	if ($this->FoodMenuMenu->save(Sanitize::clean($save, array('encode' => false)))) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash(__d('food_menu', 'The menu was edited successfully', array('class' => 'flash_success')));
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
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$this->FoodMenuMenu->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuMenu->read();
			$this->request->data['FoodMenuMenu']['deleted'] = date("Y-m-d H:i:s");
			$save['FoodMenuMenu'] = $this->request->data['FoodMenuMenu'];
			if($this->FoodMenuMenu->save($save)) {
				$this->FoodMenuMenusFoodMenuCategory->deleteAll(array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $id), false);
				$this->Session->setFlash(__d('food_menu', 'The menu was deleted successfully.', array('class' => 'flash_success')));
				$this->redirect($this->referer());
			}//if
		}//if
	}//delete
	
	function deleteMultiple() {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		if(array_key_exists('FoodMenuMenu', $this->request->data)) {
			
			debug($this->request->data);
			
			$ids = array_keys($this->request->data['FoodMenuMenu']);
			foreach ($ids as $id) {
					$this->FoodMenuMenu->id = $id;
					$this->request->data = $this->FoodMenuMenu->read();
					$this->request->data['FoodMenuMenu']['deleted'] = date("Y-m-d H:i:s");
					if($this->FoodMenuMenu->save($this->request->data)) {
						$this->FoodMenuMenusFoodMenuCategory->deleteAll(array('FoodMenuMenusFoodMenuCategory.food_menu_menu_id' => $id), false);
						continue;
					}//if
					else {
						$this->Session->setFlash(__d('food_menu', 'The menus couldn\'t be deleted', array('class' => 'flash_failure')));
						return;
					}	
			}
			$this->Session->setFlash(__d('food_menu', 'The menus were deleted.', array('class' => 'flash_success')));
			$this->redirect($this->referer());
		}
		else {
			$this->Session->setFlash(__d('food_menu', 'No menus were selected.', array('class' => 'flash_failure')));
			$this->redirect($this->referer());
		}
	}//deleteMultiple
}
?>