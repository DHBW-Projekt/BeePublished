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
			
			$this->set('shorttextLength', $shorttextLength);
			$this->set('itemsPerPage', $itemsPerPage);
			$this->set('newsblogTitle', 'A Test');
		} elseif($this->request->is('post') || $this->request->is('put')){
			$contentId = $this->request->data['contentId'];
			$newsblogTitle = $this->request->data['newsblogTitle'];
			$itemsPerPage = $this->request->data['itemsPerPage'];
			$previewTextLength = $this->request->data['previewTextLength'];
			
			$this->Session->write('Newsblog.itemsPerPage', $itemsPerPage);
			$this->Session->write('Newsblog.shorttextLength', $previewTextLength);
			$this->redirect(array('plugin' => 'Newsblog','controller' => 'ShowNews', 'action' => 'general', $contentId));
		}
		
		
	}
}