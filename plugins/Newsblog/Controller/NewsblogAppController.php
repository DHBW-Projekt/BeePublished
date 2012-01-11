<?php
class NewsblogAppController extends AppController {
	public $uses = array('Plugin');
	
	protected function getPluginId(){
		$newsblogPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsblogPlugin['Plugin']['id'];
		return $pluginId;
	}
}
