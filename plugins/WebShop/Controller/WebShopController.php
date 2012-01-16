<?php
/**
 * WebShopController
 * 
 * @author Maximilian Stueber and Patrick Zamzow
 *
 */
class WebShopController extends WebShopAppController {
	
	//Attributes
	var $components = array('ContentValueManager');
	var $uses = array('WebShop.WebshopProduct', 'WebShop.WebshopOrder', 'WebShop.WebshopPosition'); 
	var $layout = 'overlay';
	
   /**
	* Function for admin view.
	*/
	public function admin($contentID){
		$this->set('products', $this->WebshopProduct->find('all'));
		$this->set('contentID', $contentID);
	}
	
	/**
	* Function for openOrders view.
	*/
	public function openOrders($contentID){
		
		$orders = $this->WebshopOrder->findAllByStatus(0);
		
		//GET product data
		for($i = 0; $i < count($orders); $i++){
			for($b = 0; $b < count($orders[$i]['WebshopPosition']); $b++){
				$orders[$i]['WebshopPosition'][$b]['Product'] = $this->WebshopProduct->findById($orders[$i]['WebshopPosition'][$b]['product_id']);
			}
		}
		
		$this->set('orders', $orders);
		$this->set('contentID', $contentID);
	}
	
	/**
	* Function to edit product.
	*/
	public function closeOrder($contentID, $orderID=null){
		
		$this->WebshopOrder->id = $orderID;
		
		//UPDATE DB
		$order = $this->WebshopOrder->read();
		$order['WebshopOrder']['status'] = 1;
		
		$this->WebshopOrder->set($order);	
		$this->WebshopOrder->save();
		
		//REDIRECT
		$this->redirect(array('action' => 'openOrders', $contentID));
	}
	
	
   /**
	* Function to create product.
	*/
	public function create($contentID){
		
		//PROCESS cancle
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		
		$this->set('contentID', $contentID);
	
		//PROCESS save
		if (isset($this->params['data']['save']) and isset($this->data['WebshopProduct'])){
			//UPLOAD image
			if (!empty($this->data['WebshopProduct']['submittedfile']['name']))
				$result = $this->uploadImage($this->data['WebshopProduct']['submittedfile'], null, true);
			
			if (isset($result)) {
				$file_name = $result['file_name'];
			} else {
				$file_name = 'no_image.png';
			}
			
			//SAVE on DB
			$this->WebshopProduct->set(array(
						'name' => $this->data['WebshopProduct']['name'],
						'description' => $this->data['WebshopProduct']['description'],
						'price' => $this->data['WebshopProduct']['price'],
						'picture' => $file_name
			));
			
			if ($this->WebshopProduct->validates()) {
				$this->WebshopProduct->save();
				
				//REDIRECT
				$this->redirect(array('action' => 'admin', $contentID));
			}
		}
	}
	
	/**
	* Function to edit product.
	*/
	public function edit($contentID, $productID=null){
		
		//Attributes
		$update_error = false;
		
		//SET id
		$this->WebshopProduct->id = $productID;
		
		//CHECK request
		if (empty($this->data)) {
			$this->data = $this->WebshopProduct->read();
			$this->set('contentID', $contentID);
				
			return;
		}
	
		//EDIT product
		if (isset($this->params['data']['save'])) {
	
			//UPDATE db info
			$data_old = $this->WebshopProduct->read();
			$data_new = $this->data;
			
			//UPLOAD new file (if necessary)			
			if (!empty($data_new['WebshopProduct']['submittedfile']['name'])){
				$result = $this->uploadImage($data_new['WebshopProduct']['submittedfile'], $data_old['WebshopProduct']['picture'], true);
				
				$data_new['WebshopProduct']['picture'] = $result['file_name'];
				$update_error = $result['error'];
			}
			
			//SET new data
			if(!$update_error){
				$this->WebshopProduct->set($data_old);
				$this->WebshopProduct->set($data_new);
			
				//SAVE
				$update_error = !$this->WebshopProduct->save();
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
		$data = $this->WebshopProduct->findById($productID);
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot//img/products/';
		
		if ($data['WebshopProduct']['picture'] != 'no_image.png')
			@unlink($file_path.$data['WebshopProduct']['picture']);
		
		//REMOVE db entry
		$this->WebshopProduct->delete($productID);
		
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
		if(!$init_creation && $file_old != 'no_image.png'){
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
				$this->ContentValueManager->saveContentValues($contentID, array('NumberOfEntries' => $this->data['ContentValues']['NumberOfEntries']));
			}
		} else {
			$contentVars = $this->ContentValueManager->getContentValues($contentID);
			
			if (isset($contentVars['NumberOfEntries'])) {
				$this->data = array('ContentValues' => array('NumberOfEntries' => $contentVars['NumberOfEntries']));
			}
		}
		
		$this->set('contentID', $contentID);
		$this->render('settings');
	}
	
	/**
	 * Function BeforeFilter.
	 */
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('*');
	}
}