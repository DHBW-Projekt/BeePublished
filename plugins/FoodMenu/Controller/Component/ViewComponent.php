<?php
class ViewComponent extends Component {
	
	public function getData($controller, $params, $url)	{
		$controller->loadModel('FoodMenuMenu');
		$controller->loadModel('FoodMenuCategory');
		$controller->loadModel('FoodMenuEntry');
		$menu = $controller->FoodMenuMenu->find('all');
		$category = $controller->FoodMenuCategory->find('all');
		$entry = $controller->FoodMenuEntry->find('all');
		
		$data = array('FoodMenuMenu' => $menu, 'FoodMenuCategory' => $category, 'FoodMenuEntry' => $entry);
		if ($data != null)
			return $data;
		else
			return __('no entries');
	}
	
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}