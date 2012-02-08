<?php

/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

/**
*
* This Controller implements the logic for the setting in the admin overlay
* @author marcuslieberenz
*
*/
class NewsletterSettingsController extends NewsletterAppController {
	
	var $layout = 'overlay';
	var $components = array('ContentValueManager');
	
	// get and set date for index view
	public function index($contentID, $pluginId){
		$pluginText = $this->ContentValueManager->getContentValues($contentID);
		if ($this->ContentValueManager->getContentValues($contentID) == null){
			// if there is no content value show default text
			$pluginText['text'] = __d('newsletter','Here you can subscribe or unsubscribe to our newsletter.');
		}
		$this->set('pluginText', $pluginText);
		$this->set('contentID', $contentID);
		$this->set('pluginId', $pluginId);
	}
	
	// save settings
	public function save($contentID, $pluginId){
		// check if user is allowed to change settings
		$this->PermissionValidation->actionAllowed($pluginId, 'ChangeNewsletterSettings', true);
		if ($this->request->is('post')){
			// save text in content values and show flash
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

