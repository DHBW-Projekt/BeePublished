<?php

class WebShopController extends AppController {

	var $components = array('ContentValueManager');
	var $uses = array('Product'); 
	var $layout = 'overlay';
	
	public function admin($contentID){
		$this->setContentVar($contentID);
		$this->set('products', $this->Product->find('all'));
		$this->set('productAdminView', 'productsAdministration');
		$this->set('contentID', $contentID);
	}
	
	public function create($contentID){
		if (empty($this->data)) {
			$this->setContentVar($contentID);
			$this->set('productAdminView', "create");
			$this->set('contentID', $contentID);
			$this->render("admin");
		} else {
			if (isset($this->params['data']['save'])) {
				$this->createProduct($this);
			}
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	public function edit($contentID, $productID=null){
		$this->Product->id = $productID;

		if (!empty($this->data)) {
			if (isset($this->params['data']['save'])) {
				$this->Product->set($this->Product->read());
				$this->Product->set($this->data);
				$this->Product->save();
			}
			$this->redirect(array('action' => 'admin', $contentID));
		} else {
			$this->setContentVar($contentID);
			$this->data = $this->Product->read();
			$this->set('productAdminView', "edit");
			$this->set('contentID', $contentID);
			$this->render("admin");
		}
	}
	
	public function remove($contentID, $productID){
		
		//REMOVE picture
		$data = $this->Product->findById($productID);
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot/product_img/';
		
		unlink($file_path.$data['Product']['picture']);
		
		//REMOVE db entry
		$this->Product->delete($productID);
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	public function setContentValues($contentID) {
		if (!empty($this->data)) {
			if (isset($this->data['ContentValues']['NumberOfEntries'])) {
				$this->ContentValueManager->saveContentValues($contentID, $this->data['ContentValues']['NumberOfEntries']);
			}
			
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	function setContentVar($contentID) {
		$contentVars = $this->ContentValueManager->getContentValues($contentID);
		
		if (isset($contentVars['NumberOfEntries'])) {
			$this->set('numberOfEntries', $contentVars['NumberOfEntries']);
		}
	}
	
	/**
	* Create new products.
	*/
	function createProduct($controller){
		
		//CHECK request
		if (!$controller->request->is('post'))
			return;
	
		//VALIDATE data
		if(!$controller->Product->validates())
			return;
		
		/* FILE */
		$file = $controller->request->data['Product']['submittedfile'];
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot/product_img/';
		$file_name = str_replace(' ', '_', $file['name']);
		$upload_error = true;
		
		//CREATE folder
		if(!is_dir ($file_path))
			mkdir($file_path);
			
		//CHECK filetype
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
	
		foreach($permitted as $type) {
			if($type == $file['type']) {
				$upload_error = false;
				break;
			}
		}
	
		//CHECK filename
		if(file_exists($file_path.'/'.$file_name)) {
			//GET time
			ini_set('date.timezone', 'Europe/London');
			$now = date('Y-m-d-His');
	
			//NEW file-name
			$tmp = explode('.', $file_name);
			$file_name = $tmp[0].$now.'.'.$tmp[1];
		}
	
		//MOVE file
		if(!$upload_error){
			$upload_error = !move_uploaded_file($file['tmp_name'], $file_path.$file_name);
		}
	
		//SAVE on DB
		if(!$upload_error){
			//GET all data
			$data['Product']['name'] = $controller->data['Product']['name'];
			$data['Product']['description'] = $controller->data['Product']['description'];
			$data['Product']['price'] = $controller->data['Product']['price'];
			$data['Product']['picture'] = $file_name;
	
			//SAVE on db
			$upload_error = !$controller->Product->save($data);
		}
	
		//PRINT message
		if(!$upload_error){
			//$controller->Session->setFlash('Artikel wurde angelegt.', 'default', array('class' => 'flash_success'), 'Product');
		} else {
			//$controller->Session->setFlash('Fehler bei der Anlage.', 'default', array('class' => 'flash_failure'), 'Product');
		}
	}

	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}