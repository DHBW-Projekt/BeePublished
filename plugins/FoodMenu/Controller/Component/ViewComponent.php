<?php
class ViewComponent extends Component {
	
	public function getData($controller, $params, $url)	{
		$controller->loadModel('FoodMenuMenu');
		$controller->loadModel('FoodMenuCategory');
		$controller->loadModel('FoodMenuEntry');
		
		debug($params);
		debug($url);
		debug($controller);
		
//		if (isset($url)){
//			$data['Element'] = array_shift($url);
//			$func_params = $url;
//		} else {
//			$data['Element'] = $params['DefaultView'];
//			$func_params = $params;
//		}
		
		$menu = $controller->FoodMenuMenu->find('all');
//		$category = $controller->FoodMenuCategory->find('all');
//		$entry = $controller->FoodMenuEntry->find('all');
//		$data = array('FoodMenuMenu' => $menu, 'FoodMenuCategory' => $category, 'FoodMenuEntry' => $entry);
		$data = array('FoodMenuMenu' => $menu);
		$controller->set('data', $data);
		if ($data != null) {
			return $data;
		}
		else
			return __('no entries');
	}
	
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}