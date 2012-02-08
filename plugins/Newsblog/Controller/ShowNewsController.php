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
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Philipp Scholl
*
* @description Controller to manage general configuration and admin overlay
*/

App::uses('NewsblogAppController', 'Newsblog.Controller');

class ShowNewsController extends NewsblogAppController{
	public $components = array('ContentValueManager');
	
	public function admin($contentId = null){
		$this->redirect(array('plugin' => 'Newsblog','controller' => 'ShowNews', 'action' => 'general', $contentId));
	}
	
	public function general($contentId = null){
		if($this->request->is('get')){
			$this->layout = 'overlay';
			$pluginId = $this->getPluginId();
			$this->set('pluginId', $pluginId);
			$this->set('contentId', $contentId);
			//bei get session auslesen
			$shorttextLength = null;
			if($this->Session->check('Newsblog.shorttextLength')){
				$shorttextLength = $this->Session->read('Newsblog.shorttextLength');
			}
			$itemsPerPage = null;
			if($this->Session->check('Newsblog.itemsPerPage')){
				$itemsPerPage = $this->Session->read('Newsblog.itemsPerPage');
			}
			$contentValues = $this->ContentValueManager->getContentValues($contentId);
			if (array_key_exists('newsblogtitle', $contentValues)) {
				$newsblogtitle = $contentValues['newsblogtitle'];
			} else {
				$newsblogtitle = null;
			}
			$this->set('shorttextLength', $shorttextLength);
			$this->set('itemsPerPage', $itemsPerPage);
			$this->set('newsblogTitle', $newsblogtitle);
		} elseif($this->request->is('post') || $this->request->is('put')){
			$itemsPerPage = $this->request->data['itemsPerPage'];
			$previewTextLength = $this->request->data['previewTextLength'];
				
			$this->Session->write('Newsblog.itemsPerPage', $itemsPerPage);
			$this->Session->write('Newsblog.shorttextLength', $previewTextLength);
			
			if(array_key_exists('contentId', $this->request->data) & array_key_exists('newsblogTitle', $this->request->data)){
				$contentId = $this->request->data['contentId'];
				$newsblogTitle = $this->request->data['newsblogTitle'];
				$newsblogTitleData = array('newsblogtitle' => $newsblogTitle);
				$this->ContentValueManager->saveContentValues($contentId, $newsblogTitleData);
				$this->Session->setFlash(__d('newsblog', 'The changes have been saved!'));
			}
			//$this->redirect(array('plugin' => 'Newsblog','controller' => 'ShowNews', 'action' => 'general', $contentId));
			$this->redirect($this->referer());
		}
		
		
	}
	
	/**
     * beforeFilter function
     *
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('general');
    }
}