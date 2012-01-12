<?php
/**
 * WebShopController
 * 
 * @author Maximilian Stueber and Patrick Zamzow
 *
 */
class WebShopController extends AppController {
	
	//Attributes
	var $components = array('ContentValueManager');
	var $uses = array('Product'); 
	var $layout = 'overlay';
	
   /**
	* Function for admin view.
	*/
	public function admin($contentID){
		$this->setContentVar($contentID);
		$this->set('products', $this->Product->find('all'));
		$this->set('productAdminView', 'productsAdministration');
		$this->set('contentID', $contentID);
	}
	
   /**
	* Function to create product.
	*/
	public function create($contentID){
		
		//Attributes
		$create_error = false;
		
		//CHECK request
		if (empty($this->data)) {
			$this->setContentVar($contentID);
			$this->set('productAdminView', "create");
			$this->set('contentID', $contentID);
			$this->render("admin");
			
			return;
		}
		
		//PROCESS request
		if (isset($this->params['data']['save'])) {
			//CHECK request
			if (!$this->request->is('post'))
				$create_error = true;
				
			//VALIDATE data
			if(!$this->Product->validates())
				$create_error = true;
				
			//UPLOAD image
			if(!$create_error){
				$result = $this->uploadImage($this->request->data['Product']['submittedfile'], null, true);
				$create_error = $result['error'];
				$file_name = $result['file_name'];
			}
				
			//SAVE on DB
			if(!$create_error){
				$data['Product']['name'] = $this->data['Product']['name'];
				$data['Product']['description'] = $this->data['Product']['description'];
				$data['Product']['price'] = $this->data['Product']['price'];
				$data['Product']['picture'] = $file_name;
				
				//SAVE on db
				$create_error = !$this->Product->save($data);
			}
		}

		//REDIRECT
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	/**
	* Function to edit product.
	*/
	public function edit($contentID, $productID=null){
		
		//Attributes
		$update_error = false;
		
		//SET id
		$this->Product->id = $productID;
		
		//CHECK request
		if (empty($this->data)) {
			$this->setContentVar($contentID);
			$this->data = $this->Product->read();
			$this->set('productAdminView', "edit");
			$this->set('contentID', $contentID);
			$this->render("admin");
				
			return;
		}
	
		//EDIT product
		if (isset($this->params['data']['save'])) {
	
			//UPDATE db info
			$data_old = $this->Product->read();
			$data_new = $this->data;
			
			//UPLOAD new file (if necessary)
			if (!empty($data_new['Products']['submittedfile'])){
				$result = $this->uploadImage($data_new['Products']['submittedfile'], $data_old['Product']['picture'], true);
				
				$data_new['Product']['picture'] = $result['file_name'];
				$update_error = $result['error'];
			}
			
			//SET new data
			if(!$update_error){
				$this->Product->set($data_old);
				$this->Product->set($data_new);
			
				//SAVE
				$update_error = !$this->Product->save();
			}
		}
		
		//REDIRECT
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	
   /**
	* Function to remove product.
	*/
	public function remove($contentID, $productID){
		
		//REMOVE picture
		$data = $this->Product->findById($productID);
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot//img/products/';
		
		@unlink($file_path.$data['Product']['picture']);
		
		//REMOVE db entry
		$this->Product->delete($productID);
		
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
  
	
   /**
	* Function to upload image.
	*/
	function uploadImage($file, $file_old, $init_creation){
		
		/* FILE */
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot/img/products/';
		$file_name = str_replace(' ', '_', $file['name']);
		$upload_error = true;
		
		//CREATE folder
		if(!is_dir ($file_path))
			@mkdir($file_path);
			
		//CHECK filetype
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
	
		foreach($permitted as $type) {
			if($type == $file['type']) {
				$upload_error = false;
				break;
			}
		}
		
		//REMOVE old image
		if(!$init_creation){
			@unlink($file_path.$file_old);
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
			$upload_error = !@move_uploaded_file($file['tmp_name'], $file_path.$file_name);
		}
		
		//RESULT data
		$result['error'] = $upload_error;
		$result['file_name'] = $file_name;
		
		return $result;
	}
	
   /**
	* Function to set content values.
	*/
	public function setContentValues($contentID) {
		if (!empty($this->data)) {
			if (isset($this->data['ContentValues']['NumberOfEntries'])) {
				$this->ContentValueManager->saveContentValues($contentID, $this->data['ContentValues']['NumberOfEntries']);
			}
				
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	/**
	 * Function to set content values.
	 */
	function setContentVar($contentID) {
		$contentVars = $this->ContentValueManager->getContentValues($contentID);
	
		if (isset($contentVars['NumberOfEntries'])) {
			$this->set('numberOfEntries', $contentVars['NumberOfEntries']);
		}
	}
	
	/**
	 * Function BeforeFilter.
	 */
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}