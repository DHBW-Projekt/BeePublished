<?php

class GoogleMapsComponent extends Component {

	public function getLocation($controller, $params)
	{
		if (!array_key_exists('LocationID',$params)) {
			return __('no location');
		} else {					
			$controller->loadModel("GoogleMapsLocation");
			$location = $controller->GoogleMapsLocation->find('first', array('conditions' => array('GoogleMapsLocation.id' => $params['LocationID'])));
			if ($location != null) {
				return $location;
			} else {
				return __('no location');
			}
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}