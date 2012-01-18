<?php

class FoodMenuAppController extends AppController {
	
	var $helpers = array('Number');
	public $uses = array('Plugin');
	
	protected function getPluginId(){
		$foodMenuPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $foodMenuPlugin['Plugin']['id'];
		return $pluginId;
	}

}