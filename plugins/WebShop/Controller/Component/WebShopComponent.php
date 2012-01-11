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
		} else if (isset($params['DefaultView'])) {
			$data['Element'] = $params['DefaultView'];
			$func_params = $params;
		} else {
			$data['Element'] = 'productOverview';
			$func_params = null;
		}
		
		//CALL corresponding comp. method
		if (method_exists($this, $data['Element'])){
			$func_data = $this->{$data['Element']}($controller, $func_params);
			if (isset($func_data['data'])) {
				$data['data'] = $func_data['data'];
			}
			if (isset($func_data['Element'])) {
				$data['Element'] = $func_data['Element'];
			}
		}
		
		//RETURN data
		if ($data != null) {
			if (!isset($data['data'])) { $data['data'] = null; }
			if (!isset($data['Element'])) { $data['Element'] = null; }
			
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
		$controller->loadModel("Product");
			
		//PAGINATION options
		$controller->paginate = array('order' => array( 'Product.created' => 'desc'),
							       	  'limit' => $params['NumberOfEntries']);
	
		//RETURN results for view
		return array('data' => $controller->paginate('Product'));
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
			return array('data' => $controller->paginate('Product'));
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
			return array('data' => $controller->paginate('Product'));
		}
	}
	
   /**
	* Dislays product details.
	*/
	function view($controller, $id=null) {
		
		//LOAD model
		$controller->loadModel('Product');
		
		//RETURN product
		return array('data' => $controller->Product->findById($id));
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
		return array('data' => $data);
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
		
		//SORT
		sort($productIDs);
			
		//WRITE to SESSION		
		$controller->Session->write('products', $productIDs);
		
		//REDIRECT to cart
		$data = $this->cart($controller);
		return array('Element' => 'cart', 'data' => $data['data']);
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
		
		//SORT
		sort($productIDs);
	
		//WRITE to SESSION
		$controller->Session->write('products', $productIDs);
	
		//REDIRECT to cart
		$data = $this->cart($controller);
		return array('Element' => 'cart', 'data' => $data['data']);
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
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();
		$email->template('order', 'email')
			  ->emailFormat('html')
			  ->to('maximilian.stueber@me.com')
	          ->from('noreply@'.env('SERVER_NAME'), env('SERVER_NAME'))
			  ->subject('Order')
			  ->viewVars(array(
		        	'order' => $productIDs,
					'url' => env('SERVER_NAME'),
		))
		->send();
		
		//UNSET cart
		$controller->Session->write('products', null);
		
		//REDIRECT to cart
		$data = $this->cart($controller);
		return array('Element' => 'cart', 'data' => $data['data']);
	}	
}