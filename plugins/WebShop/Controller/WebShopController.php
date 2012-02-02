<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Wuerttemberg Mannheim
 * @author Maximilian Stueber and Patrick Zamzow
 *
 * @description Controller for WebShop.
 */

App::uses('Sanitize', 'Utility');

class WebShopController extends WebShopAppController {
	
	//Attributes
	var $components = array('ContentValueManager');
	var $uses = array('WebShop.WebshopProduct', 'WebShop.WebshopOrder', 'WebShop.WebshopPosition', 'User'); 
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
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Close Order');
		if(!$allowed)
			$this->redirect(array('action' => 'openOrders', $contentID));
		
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
		
		//Attributes
		$create_error = null;
		$error_message = __d('web_shop', 'Please fill out all mandatory fields.');
		
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Create Product');
		
		if(!$allowed){
			$this->Session->setFlash(__d('web_shop', 'Permission denied.'), 'default', array(
					'class' => 'flash_failure'));
			
			$this->redirect(array('action' => 'admin', $contentID));
		}
		
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
				$create_error = $result['error'];
				$error_message = __d('web_shop', 'Errors during picture upload.');
			} else {
				$file_name = 'no_image.png';
			}
			
			//SAVE on DB
			if (!$create_error){
				
				//SANITIZE
				$this->data =  Sanitize::clean($this->data);
				
				$this->WebshopProduct->set(array(
							'name' => $this->data['WebshopProduct']['name'],
							'description' => $this->data['WebshopProduct']['description'],
							'price' => $this->data['WebshopProduct']['price'],
							'picture' => $file_name,
				));
				
				//VALIDATE
				if ($this->WebshopProduct->validates())
					$create_error = !$this->WebshopProduct->save();
				else 
					$create_error = true;
			}
		}
		
		//PRINT messages
		if (isset($create_error) and !$create_error){
			$this->Session->setFlash(__d('web_shop', 'Product created.'));
			
			//REDIRECT
			$this->redirect(array('action' => 'admin', $contentID));
		}else if (isset($create_error)){
			$this->Session->setFlash($error_message, 'default', array(
					'class' => 'flash_failure'));
		}
	}
	
	/**
	* Function to edit product.
	*/
	public function edit($contentID, $productID=null){
		
		//Attributes
		$update_error = false;
		$error_message = __d('web_shop', 'Please fill out all mandatory fields.');
		$request = null;
		
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Edit Product');
		
		if(!$allowed){
			$this->Session->setFlash(__d('web_shop', 'Permission denied.'), 'default', array(
							'class' => 'flash_failure'));
				
			$this->redirect(array('action' => 'admin', $contentID));
		}
		
		//PROCESS cancle
		if (isset($this->params['data']['cancel']))
			$this->redirect(array('action' => 'admin', $contentID));
		
		//SET data
		$this->WebshopProduct->id = $productID;
		$this->set('contentID', $contentID);
		
		//PROCESS save
		if (isset($this->params['data']['save'])) {
			//UPDATE db info
			$data_old = $this->WebshopProduct->read();
			
			//SANITIZE
			$this->data =  Sanitize::clean($this->data);

			$data_new = $this->data;
			$data_new['WebshopProduct']['picture'] = $data_old['WebshopProduct']['picture'];
			
			//UPLOAD new file (if necessary)			
			if (!empty($data_new['WebshopProduct']['submittedfile']['name'])){
				$result = $this->uploadImage($data_new['WebshopProduct']['submittedfile'], $data_old['WebshopProduct']['picture'], false);
				
				$update_error = $result['error'];
				$data_new['WebshopProduct']['picture'] = $result['file_name'];

				if($update_error){
					$error_message = __d('web_shop', 'Errors during picture upload.');
					$data_new['WebshopProduct']['picture'] = $data_old['WebshopProduct']['picture'];
				}
			}
			
			//SAVE
			if(!$update_error){
				$this->WebshopProduct->set(array('picture' => $data_new['WebshopProduct']['picture']));
				$this->WebshopProduct->save();
			}
			
			//SET data
			if(!$update_error){
				$this->WebshopProduct->set($data_old);
				$this->WebshopProduct->set($data_new);
			
				$update_error = !$this->WebshopProduct->validates();
			}

			//SAVE
			if(!$update_error){
				$update_error = !$this->WebshopProduct->save();
			}
		
			//PRINT messages
			if (!$update_error){
				$this->Session->setFlash(__d('web_shop', 'Product updated.'));
				
				//REDIRECT
				$this->redirect(array('action' => 'admin', $contentID));
			}else{
				$this->Session->setFlash($error_message, 'default', array(
								'class' => 'flash_failure'));
			}
			
			$data_new['WebshopProduct']['id'] = $productID;
			$this->data = $data_new;
		}else{
			$this->data = $this->WebshopProduct->read();
		}
	}
	
	
   /**
	* Function to remove product.
	*/
	public function remove($contentID, $productID, $redirect = true){
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Delete Product');
		if(!$allowed)
			$this->redirect(array('action' => 'admin', $contentID));
		
		//REMOVE picture
		$data = $this->WebshopProduct->findById($productID);
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot//img/products/';
		
		if ($data['WebshopProduct']['picture'] != 'no_image.png')
			@unlink($file_path.$data['WebshopProduct']['picture']);
		
		//REMOVE db entry
		$this->WebshopProduct->delete($productID);
		
		if ($redirect){
			$this->Session->setFlash(__d('web_shop', 'Product deleted.'));
			$this->redirect(array('action' => 'admin', $contentID));
		}
	}
	
	public function removeSelected($contentID){
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Delete Product');
		if(!$allowed)
			$this->redirect(array('action' => 'admin', $contentID));
		
		$deleted = false;
		
		if (isset($this->data['selectedProducts']))
			foreach ($this->data['selectedProducts'] as $product => $selection) {
				if ($selection) {
					$this->remove($contentID, $product, false);
					$deleted = true;
				}
			}
		
		if ($deleted)
			$this->Session->setFlash(__d('web_shop', 'Products deleted.'));
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
  
	
   /**
	* Function to upload image.
	*/
	function uploadImage($file, $file_old, $init_creation){
		
		/* FILE */
		$file_path = WWW_ROOT.'uploads/products/';
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
		if(!$upload_error && !$init_creation && $file_old != 'no_image.png'){
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
		//Check permissions
		$pluginId = $this->getPluginId();
		$allowed = $this->PermissionValidation->actionAllowed($pluginId, 'Set WebShop Settings');
		if(!$allowed)
			$this->redirect(array('action' => 'admin', $contentID));
		
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
}