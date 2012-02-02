<?php

class NewsletterSettingsController extends NewsletterAppController {
	
	var $layout = 'overlay';
	var $components = array('ContentValueManager');
	
	public function index($contentID, $pluginId){
		$pluginText = $this->ContentValueManager->getContentValues($contentID);
		if ($this->ContentValueManager->getContentValues($contentID) == null){
			$pluginText['text'] = __d('newsletter','Here you can subscribe or unsubscribe to our newsletter.');
		}
		$this->set('pluginText', $pluginText);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	public function save($contentID, $pluginId){
		$this->PermissionValidation->actionAllowed($pluginId, 'ChangeNewsletterSettings', true);
		if ($this->request->is('post')){
			$text = $this->data['text'];
			$contentValue['text'] = $text; 
			$this->ContentValueManager->saveContentValues($contentID, $contentValue);
			$this->Session->setFlash(__d('newsletter','The text was saved successfully.'), 'default', array(
				'class' => 'flash_success'), 
				'TextSaved');
			$this->redirect($this->referer());
		}
	}
	
}

