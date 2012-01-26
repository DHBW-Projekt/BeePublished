<?php
class GalleryAppController extends AppController {

	var $components = array('ContentValueManager');
	
	public $uses = array('Plugin');
	
	protected function getPluginId(){
		$foodMenuPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $foodMenuPlugin['Plugin']['id'];
		return $pluginId;
	}
	
}