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
		for($i = 0; $i <= $productIDs; $i++){
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
		
		//REDIRECT to product page
		$controller->redirect(array('plugin' => 'webshop', 'controller' => '', 'action' => 'view', $id));
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