<?php

class LocationComponent extends Component {
	
	public $components = array('GoogleMaps.GoogleMaps');
	
	public function getData($controller, $params, $url)
	{
		return $this->GoogleMaps->getLocation($controller, $params);
	}	
}