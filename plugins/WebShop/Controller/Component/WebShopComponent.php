<?php
/**
 * Component for WebShopComponent.
 *
 * @author Patrick Zamzow
 * @version 26.12.2011
 */
class WebShopComponent extends Component {
   
   /**
	* Method to transfer data from plugin to CMS.
	*/
	public function getData($controller, $params, $url)
	{		
		//CHECK url
		if (isset($url)){
			$data['Element'] = array_shift($url);
			$func_params = $url;
		} else {
			$data['Element'] = $params['DefaultView'];
			$func_params = $params;
		}
		
		//CALL corresponding comp. method
		if (method_exists($this, $data['Element'])){
			$data['data'] = call_user_method($data['Element'], $this, $controller, $func_params);
		}
		
		//RETURN data
		if ($data != null) {
			return $data;
		} else {
			return __('no data');
		}
	}
	
	/**
	 * Product-Overview.
	 */
	function productOverview($controller, $params){
		
		//LOAD model
		$controller->loadModel("Products");
		
		//RETURN products
		return $controller->Products->find('all', array('limit'=>$params['NumberOfEntries'],'order' => array('created' => 'desc')));
	}
	
   /**
	* Product-Search.
	*/
	function search($controller){
		
		//LOAD model
		$controller->loadModel('Product');
		
		if (!empty($controller->data)) {
			//SEARCH for products using MySQL fulltext search
			$params = array('conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$controller->data['Search']['Suche'].'" IN BOOLEAN MODE)'));
			
			//RETURN results for view
			return $controller->Product->find('all', $params);
		}
	}
	
   /**
	* Dislays product details.
	*/
	function view($controller, $id=null) {
		
		//LOAD model
		$controller->loadModel('Product');
		
		//RETURN product
		return $controller->Product->findById($id);
	}
	
	/**
	* Create new products.
	*/
	function create($controller){
	
		//LOAD model
		$controller->loadModel('Product');
		
		//CHECK request
		if (!$controller->request->is('post'))
			return;
	
		/* FILE */
		$file = $controller->request->data['Product']['submittedfile'];
		$file_path = WWW_ROOT.'../../plugins/WebShop/webroot/img/';
		$file_name = str_replace(' ', '_', $file['name']);
		$upload_error = true;
		
			
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
			$file_name = $file_name.$now;
		}
		
		//MOVE file
		if(!$upload_error){
			move_uploaded_file($file['tmp_name'], $file_path.$file_name);
		}
		
		//GET all data
		$data['Product']['name'] = $controller->data['Product']['name'];
		$data['Product']['description'] = $controller->data['Product']['description'];
		$data['Product']['price'] = $controller->data['Product']['price'];
		$data['Product']['picture'] = $file_path.$file_name;
		
		//SAVE on db
		if ($controller->Product->save($data)) {
			$controller->Session->setFlash('Artikel wurde angelegt.');
		}
	}
	
   /**
	* Displays all the products of shopping cart.
	*/
	function cart($controller) {
		
		//ATTRIBUTES
		$data = array();
		
		//LOAD model
		$controller->loadModel('Product');
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('products');
		
		//COLLECT data
		foreach ((!isset($productIDs)) ? array() : $productIDs as $productID) {
			$product = $controller->Product->findById($productID['id'], array('fields' => 'Product.id, Product.name, Product.price, Product.picture'));
			$product['count'] = $productID['count'];
			array_push($data, $product);
		}
		
		//RETURN products
		return $data;
	}
	
   /**
	* Adds product to shopping cart.
	*/
	function add($controller, $id=null) {
		
		//ATTRIBUTES
		$productIDs = $controller->Session->read('products');
		$positon = array();
		$results = false;
	
		//CHECK existing products in cart
		for($i = 0; $i < count($productIDs); $i++){
			if ($productIDs[$i]['id'] == $id){
				$productIDs[$i]['count'] = $productIDs[$i]['count'] + 1;
				$results = true;
				break;
			}
		}

		//ADD if new
		if(!$results){
			$positon['id'] = $id;
			$positon['count'] = 1;
				
			if ($productIDs == null) {
				$productIDs[0] = $positon;
			} else {
				array_push($productIDs, $positon);
			}
		}
			
		//WRITE to SESSION		
		$controller->Session->write('products', $productIDs);
		
		//REDIRECT to cart
		$controller->redirect('/webshop/cart');
	}
	
   /**
	* Removes product from shopping cart.
	*/
	function remove($controller, $id=null) {
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('products');
	
		//REMOVE prod. from cart
		for($i = 0; $i < count($productIDs); $i++){
			if ($productIDs[$i]['id'] == $id){
				$productIDs[$i]['count'] = $productIDs[$i]['count'] - 1;
				break;
			}
		}
	
		//WRITE to SESSION
		$controller->Session->write('products', $productIDs);
	
		//REDIRECT to cart
		$controller->redirect('/webshop/cart');
	}
	
	/**
	* BeforeFilter.
	*/
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}