<?php

class WebShopController extends AppController {
		
	var $layout = 'overlay';
	
	public function admin($contentID){
		$this->loadModel("ContentValues");
		$this->loadModel("GoogleMapsLocation");
		
		pr($this->data);
	}
	
	public function create(){
		echo "test";
	}

	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}