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
		
		//DATA from request
		if (!empty($controller->data)) {
			
			//PAGINATION options
			$controller->paginate = array(
					        'conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$controller->data['Search']['Suche'].'" IN BOOLEAN MODE)'),
					        'limit' => 10
			);
			
			//WRITE search-key to session
			$controller->Session->write('searchkey', $controller->data['Search']['Suche']);
			
			//RETURN results for view
			return $controller->paginate('Product');
		}
		
		//DATA from session
		$search_key = $controller->Session->read('searchkey');
		
		if (!empty($search_key)){
			
			//PAGINATION options
			$controller->paginate = array(
								        'conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$search_key.'" IN BOOLEAN MODE)'),
								        'limit' => 10
			);
			
			//RETURN results for view
			return $controller->paginate('Product');
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
		
		//VALIDATE data
		if(!$controller->Product->validates())
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
			$tmp = explode('.', $file_name);	
			$file_name = $tmp[0].$now.'.'.$tmp[1];
		}
		
		//MOVE file
		if(!$upload_error){
			move_uploaded_file($file['tmp_name'], $file_path.$file_name);
		}
		
		//GET all data
		$data['Product']['name'] = $controller->data['Product']['name'];
		$data['Product']['description'] = $controller->data['Product']['description'];
		$data['Product']['price'] = $controller->data['Product']['price'];
		$data['Product']['picture'] = $file_name;
		
		//SAVE on db
		if ($controller->Product->save($data)) {
			$controller->Session->setFlash('Artikel wurde angelegt.', 'default', array('class' => 'flash_success'), 'Product');
		}else{
			$controller->Session->setFlash('Fehler bei der Anlage.', 'default', array('class' => 'flash_failure'), 'Product');
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
				
				if($productIDs[$i]['count'] == 1)
					unset($productIDs[$i]);
				else
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
	 * Submit oder to Administrator.
	 */
	function submitOrder($controller){
		
		//LOAD model
		$controller->loadModel('Product');
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('products');
		
		//BUILD mail
		$subject = '---- Bestellung ----';
		$text_start = 'Eine neue Bestellung wurde aufgegeben:<br>';
		$text_ende = '<br><br><br>#### Diese Nachricht wurde automatisch erstellt ####';
		
		$user_data = '<br><br><br>';
		$order = '';
		
		//GET products
		foreach($productIDs as $productID){
			$product = $controller->Product->findById($productID['id'], array('fields' => 'Product.id, Product.name, Product.price, Product.picture'));
			$order = $order.'<br>'.$product['Product']['name'].' ('.$product['Product']['id'].'): Menge '.$productID['count'];
		}
		
		//SEND email
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();
		$email->from(array('maximilian.stueber@me.com' => 'DualonCMS'));
		$email->to('maximilian.stueber@me.com');
		$email->subject($subject);
		
		//UNSET cart
		$controller->Session->write('products', null);
		
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