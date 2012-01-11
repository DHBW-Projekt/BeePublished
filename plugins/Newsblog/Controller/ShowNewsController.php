<?php
App::uses('NewsblogAppController', 'Newsblog.Controller');

class ShowNewsController extends NewsblogAppController{
	public function admin($contentId = null){
		$this->redirect(array('plugin' => 'Newsblog','controller' => 'NewsEntries', 'action' => 'create', $contentId));
		
		/*$this->layout = 'overlay';
		
		$pluginId = $this->getPluginId();
		$this->set('pluginId', $pluginId);
		$this->set('contentId', $contentId);*/
	}
}