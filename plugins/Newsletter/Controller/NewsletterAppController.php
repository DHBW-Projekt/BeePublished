<?php

class NewsletterAppController extends AppController {
	public $uses = array('Plugin');
	
	public function getPluginId(){
		$newsletterPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsletterPlugin['Plugin']['id'];
		return $pluginId;
	}
	
/**
     * beforeFilter function
     *
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('unSubscribePerMail');
    }
}

