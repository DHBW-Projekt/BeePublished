<?php

class ViewController extends AppController {
	
	public $name = 'View';
	public $uses = array('FoodMenu.FoodMenuMenu');
	var $autoLayout = false;


	function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

	public function admin( $contentID ) {
	}

	public function content( ) {
	
	}
}
?>