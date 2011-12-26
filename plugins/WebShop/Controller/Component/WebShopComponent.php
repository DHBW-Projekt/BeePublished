<?php

class WebShopComponent extends Component {
	
	
	public function getData($controller, $params, $url)
	{		
		if (isset($url)){
			$data['Element'] = array_shift($url);
			$func_params = $url;
		} else {
			$data['Element'] = $params['DefaultView'];
			$func_params = $params;
		}
		
		if (method_exists($this, $data['Element'])){
			$data['data'] = call_user_method($data['Element'], $this, $controller, $func_params);
		}
		
		if ($data != null) {
			return $data;
		} else {
			return __('no data');
		}
	}
	
	function productOverview($controller, $params){
		$controller->loadModel("Products");
		
		return $controller->Products->find('all', array('limit'=>$params['NumberOfEntries'],'order' => array('created' => 'desc')));
	}
	
	function search($controller){
		if (!empty($controller->data)) {
			$controller->loadModel('Product');
				
			$params = array('conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$controller->data['Search']['Suche'].'" IN BOOLEAN MODE)'));
			return $controller->Product->find('all', $params);
		}
	}
	
	function view($controller, $id=null) {
		$controller->loadModel('Product');
	
		return $controller->Product->findById($id);
	}
	
	function cart($controller) {
		$productIDs = $controller->Session->read('products');
	
		$controller->loadModel('Product');
		$products = array();
		foreach ($productIDs as $productID) {
			$product = $controller->Product->findById($productID['id'], array('fields' => 'Product.name'));
			$product['count'] = $productID['count'];
			array_push($products, $product);
		}
		return $products;
	}
	
	function add($id=null) {
		$productIDs = $this->Session->read('products');
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
			
	
		$this->Session->write('products', $productIDs);
		$this->redirect(array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $id));
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}