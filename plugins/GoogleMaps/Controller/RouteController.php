<?php

class RouteController extends GoogleMapsAppController {

	var $layout = 'overlay';
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('*');
	}
}