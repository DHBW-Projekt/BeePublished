<?php

class WebShopAppController extends AppController {
	public $uses = array('Plugin');
	
	protected function getPluginId(){
		$WebShop = $this->Plugin->findByName($this->plugin);
		$pluginId = $WebShop['Plugin']['id'];
		return $pluginId;
	}
}

