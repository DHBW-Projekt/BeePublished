<?php

class StaticTextAppController extends AppController {
	// Includes the Component
	public $components = array('StaticText.DisplayText');
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}

