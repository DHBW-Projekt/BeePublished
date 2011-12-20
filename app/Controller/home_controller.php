<?php
class HomeController extends AppController {
		
	function display() {
		$content = array('module_name' => '	', 'view_name' => 'simple_texts');
		
		$this->set('content', $plugin_content);
	}
	
	function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('display');
	}
	
}