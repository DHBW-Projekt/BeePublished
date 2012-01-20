<?php
/**
 * Component for WebShopComponent.
 *
 * @author Patrick Zamzow
 * @version 26.12.2011
 */
class WebShopComponent extends Component {
	
	//Attributes
	var $components = array('BeeEmail', 'Config');
	
   /**
	* Method to transfer data from plugin to CMS.
	*/
	public function getData($controller, $params, $url, $contentId, $myUrl)
	{		
		//CHECK url
		if (isset($url)){
			$data['Element'] = array_shift($url);
		} else {
			$data['Element'] = 'productOverview';
		}
		
		//CALL corresponding comp. method
		if (method_exists($this, $data['Element'])){
			$func_data = $this->{$data['Element']}($controller, $url, $params, $myUrl);
			if (isset($func_data['data'])) {
				$data['data'] = $func_data['data'];
			}
			if (isset($func_data['Element'])) {
				$data['Element'] = $func_data['Element'];
			}
		}
		
		//RETURN data
		if (!isset($data['data'])) { $data['data'] = null; }
			
		return $data;
	}
	
	/**
	 * Product-Overview.
	 */
	function productOverview($controller, $url_params, $contentValues){
		
		//LOAD model
		$controller->loadModel("WebshopProduct");
		
		//Default NumberOfEntries
		if(!isset($contentValues['NumberOfEntries']))
			$contentValues['NumberOfEntries'] = 5;
			
		//PAGINATION options
		$controller->paginate = array('order' => array( 'WebshopProduct.created' => 'desc'),
						       	  'limit' => $contentValues['NumberOfEntries']);
		
		//Result data
		$result['Product'] = $controller->paginate('WebshopProduct');
		$result['Limit'] = $contentValues['NumberOfEntries'];
		
		//RETURN results for view
		return array('data' => $result);
	}
	
   /**
	* Product-Search.
	*/
	function search($controller, $url_params, $contentValues){
		
		//LOAD model
		$controller->loadModel('WebshopProduct');
		
		//Default NumberOfEntries
		if(!isset($contentValues['NumberOfEntries']))
			$contentValues['NumberOfEntries'] = 5;
		
		//DATA from request
		if (!empty($controller->data)) {
			
			//PAGINATION options
			$controller->paginate = array(
					        'conditions' => array('MATCH(WebshopProduct.name,WebshopProduct.description) AGAINST("'.$controller->data['Search']['SearchInput'].'" IN BOOLEAN MODE)'),
					        'limit' => $contentValues['NumberOfEntries']
			);
			
			//WRITE search-key to session
			$controller->Session->write('searchkey', $controller->data['Search']['SearchInput']);
			
			//RESULT data
			$result['search'] = $controller->paginate('WebshopProduct');
			$result['limit'] = $contentValues['NumberOfEntries'];
			
			//RETURN results for view
			return array('data' => $result);
		}
		
		//DATA from session
		$search_key = $controller->Session->read('searchkey');
		
		if (!empty($search_key)){
			
			//PAGINATION options
			$controller->paginate = array(
								        'conditions' => array('MATCH(WebshopProduct.name,WebshopProduct.description) AGAINST("'.$search_key.'" IN BOOLEAN MODE)'),
								        'limit' => $contentValues['NumberOfEntries']
			);
			
			//RESULT data
			$result['search'] = $controller->paginate('WebshopProduct');
			$result['limit'] = $contentValues['NumberOfEntries'];
			
			//RETURN results for view
			return array('data' => $result);
		}
	}
	
   /**
	* Dislays product details.
	*/
	function view($controller, $id=null) {
		
		//LOAD model
		$controller->loadModel('WebshopProduct');

		//RETURN product
		return array('data' => $controller->WebshopProduct->findById($id));
	}
	
   /**
	* Displays all the products of shopping cart.
	*/
	function cart($controller) {
		
		//ATTRIBUTES
		$data = array();
		
		//LOAD model
		$controller->loadModel('WebshopProduct');
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('webshop_cart');
		
		//COLLECT data
		foreach ((!isset($productIDs)) ? array() : $productIDs as $productID) {
			$product = $controller->WebshopProduct->findById($productID['id'], array('fields' => 'WebshopProduct.id, WebshopProduct.name, WebshopProduct.price, WebshopProduct.picture'));
			$product['count'] = $productID['count'];
			array_push($data, $product);
		}
		
		//RETURN products
		return array('data' => $data);
	}
	
   /**
	* Adds product to shopping cart.
	*/
	function add($controller, $id=null, $contentValues=null, $url=null) {
		
		//ATTRIBUTES
		$productIDs = $controller->Session->read('webshop_cart');
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
		$controller->Session->write('webshop_cart', $productIDs);
		
		//REDIRECT to cart
		$controller->redirect($url.'/webshop/cart');
	}
	
   /**
	* Removes product from shopping cart.
	*/
	function remove($controller, $id=null, $contentValues=null, $url=null) {
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('webshop_cart');
	
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
		$controller->Session->write('webshop_cart', $productIDs);
	
		//REDIRECT to cart
		$controller->redirect($url.'/webshop/cart');
	}
	
	/**
	 * Submit oder to Administrator.
	 */
	function submitOrder($controller, $pluginID=null, $contentValues=null, $url=null){
		
		//Check if user is allowed to submit orders
		if (!$controller->PermissionValidation->actionAllowed($pluginID, 'Submit Order')) {
			$controller->redirect($url.'/webshop/cart');
		}
		
		//Attributs
		$order = array();
		$pos_data = array();
		
		//LOAD model
		$controller->loadModel('WebshopOrder');
		$controller->loadModel('WebshopPosition');
		$controller->loadModel('WebshopProduct');

		//CREATE order on DB
		$controller->WebshopOrder->set(array('customer_id' => '4',
											 'status' => '0'
		));
		$controller->WebshopOrder->save();
		
		//GET all IDs (+ amount) from session
		$productIDs = $controller->Session->read('webshop_cart');
		
		foreach ((!isset($productIDs)) ? array() : $productIDs as $productID) {
			$product = $controller->WebshopProduct->findById($productID['id'], array('fields' => 'WebshopProduct.id, WebshopProduct.name, WebshopProduct.price'));
			$product['count'] = $productID['count'];
			array_push($order, $product);
			
			array_push($pos_data,
					   array('WebshopPosition' => array(
									'product_id' => $productID['id'][0],
									'order_id' => $controller->WebshopOrder->id,
									'count' => $product['count']))
			);
		}
		
		//CREATE positions on DB
		$controller->WebshopPosition->saveMany($pos_data, array('validate' => 'false'));
		
		//SEND mail
		$this->BeeEmail->sendHtmlEmail($to = $this->Config->getValue('email'), $subject = 'DualonCMS: New Order', $viewVars = array('order' => $order, 'url' => 'localhost'/*env('SERVER_NAME')*/), $viewName = 'WebShop.order');
		
		//UNSET cart
		$controller->Session->write('webshop_cart', null);
		
		//REDIRECT to cart
		$controller->redirect($url.'/webshop/productOverview');
	}	
}