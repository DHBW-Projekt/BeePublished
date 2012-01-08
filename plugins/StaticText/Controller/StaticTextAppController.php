<?php

class StaticTextAppController extends AppController {
	// Includes the Component
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}

