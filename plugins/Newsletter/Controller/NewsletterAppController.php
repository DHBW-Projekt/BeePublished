<?php

class NewsletterAppController extends AppController {
	public $uses = array('Plugin');
	
	public function getPluginId(){
		$newsletterPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsletterPlugin['Plugin']['id'];
		return $pluginId;
	}
}

