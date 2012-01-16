<?php

class NewsletterSettingsController extends AppController {
	
	var $layout = 'overlay';
	var $components = array('ContentValueManager');
	
	
	public function index($contentID){
		$pluginText = $this->ContentValueManager->getContentValues($contentID);
		$this->set('pluginText', $pluginText);
		$this->set('contentID', $contentID);
	}
	
	public function save($contentID){
		if ($this->request->is('post')){
			$text = $this->data['text'];
			$contentValue['text'] = $text; 
			$this->ContentValueManager->saveContentValues($contentID, $contentValue);
			$this->redirect($this->referer());
		}
	}
	
}

