<?php

class RouteComponent extends Component {
	
	public $components = array('GoogleMaps.GoogleMaps');
	
	public function getData($controller, $params, $url)
	{
		return $this->GoogleMaps->getLocation($controller, $params);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}