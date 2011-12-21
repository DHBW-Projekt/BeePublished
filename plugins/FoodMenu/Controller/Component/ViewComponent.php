<?php
class ViewComponent extends Component {
	
	public function getData($controller, $params, $url)
	{
		var_dump($params);
		$controller->loadModel("FoodMenuEntry");
		$entries = $controller->FoodMenuEntry->find('all');
		if ($entries != null) {
			return $entries;
		} else {
			return __('no entries');
		}
	}
}