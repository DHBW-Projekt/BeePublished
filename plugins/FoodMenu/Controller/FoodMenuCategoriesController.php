<?php
App::uses('Sanitize', 'Utility');
class FoodMenuCategoriesController extends FoodMenuAppController {

	public $name = 'FoodMenuCategories';
	public $uses = array('FoodMenu.FoodMenuMenu', 'FoodMenu.FoodMenuCategory', 'FoodMenu.FoodMenuEntry', 'FoodMenu.FoodMenuMenusFoodMenuCategory', 'FoodMenu.FoodMenuCategoriesFoodMenuEntry');
	var $layout = 'overlay';

	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }

	public function index() {
		$pluginId = $this->getPluginId();
		$categories = $this->FoodMenuCategory->find('all', array('conditions' => array('deleted' => null)));
		$this->set('categories', $categories);
	}//index
	
	function create() {
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
		if ($this->request->is('post') && isset($this->request->data['FoodMenuCategory'])) {			
            if ($this->FoodMenuCategory->save(Sanitize::clean($this->request->data, array('encode' => false)))) {
                $this->Session->setFlash(__d('food_menu', 'The category has been saved.', array('class' => 'flash_success')));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('food_menu', 'The category couldn\'t be saved.', array('class' => 'flash_failure')));
            }//else
        }//if
	}//create
	
	function edit($name = null, $id = null) {	
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		// Has any form data been POSTed?
    	if ($this->request->is('post') && isset($this->request->data['FoodMenuCategory'])) {
        	// If the form data can be validated and saved...
        	$save = $this->request->data;
        	if ($this->FoodMenuCategory->save(Sanitize::clean($save, array('encode' => false)))) {
            	// Set a session flash message and redirect.
            	$this->Session->setFlash(__d('food_menu', 'The category has been changed.', array('class' => 'flash_success')));
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
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$this->FoodMenuCategory->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->FoodMenuCategory->read();
			$this->request->data['FoodMenuCategory']['deleted'] = date("Y-m-d H:i:s");
			$save['FoodMenuCategory'] = $this->request->data['FoodMenuCategory'];
			if($this->FoodMenuCategory->save($save)) {
				$this->FoodMenuMenusFoodMenuCategory->deleteAll(array('FoodMenuMenusFoodMenuCategory.food_menu_category_id' => $id), false);
				$this->FoodMenuCategoriesFoodMenuEntry->deleteAll(array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $id), false);
				$this->Session->setFlash(__d('food_menu', 'The category has been deleted.', array('class' => 'flash_success')));
				$this->redirect($this->referer());
			}//if
		}//if
	}//delete
	
	function deleteMultiple() {
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		if(array_key_exists('FoodMenuCategory', $this->request->data)) {
			$ids = array_keys($this->request->data['FoodMenuCategory']);
			foreach ($ids as $id) {
					$this->FoodMenuCategory->id = $id;
					$this->request->data = $this->FoodMenuCategory->read();
					$this->request->data['FoodMenuCategory']['deleted'] = date("Y-m-d H:i:s");
					if($this->FoodMenuCategory->save($this->request->data)) {
						$this->FoodMenuMenusFoodMenuCategory->deleteAll(array('FoodMenuMenusFoodMenuCategory.food_menu_category_id' => $id), false);
						$this->FoodMenuCategoriesFoodMenuEntry->deleteAll(array('FoodMenuCategoriesFoodMenuEntry.food_menu_category_id' => $id), false);
						continue;
					}//if
					else {
						$this->Session->setFlash(__d('food_menu', 'Errors occured during deleting.', array('class' => 'flash_failure')));
						return;
					}	
			}
			$this->Session->setFlash(__d('food_menu', 'The categories have been deleted.', array('class' => 'flash_success')));
			$this->redirect($this->referer());
		}
		else {
			$this->Session->setFlash(__d('food_menu', 'No categories were selected.', array('class' => 'flash_failure')));
			$this->redirect($this->referer());
		}
	}
	
}
?>