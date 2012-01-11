<?php
class ShowNewsController extends AppController{
	var $autoLayout = false;
	public $uses = array('Newsblog.NewsEntry', 'Plugin');
	public $helpers = array('Html');
	public $components = array('Menu', 'RequestHandler');
	
	public function admin($contentId = null){
		$this->autoLayout = true;
		$this->layout = 'overlay';
		
		$newsblogPlugin = $this->Plugin->findByName('Newsblog');
		$pluginId = $newsblogPlugin['Plugin']['id'];
		$this->set('pluginId', $pluginId);
		$this->set('contentId', $contentId);
		$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
		if($publishAllowed){
			$conditions = array("NewsEntry.content_id" => $contentId, "NewsEntry.published !=" => true, "NewsEntry.deleted !=" => true);
				
			$options['conditions'] = $conditions;
			$options['order'] = array("createdOn DESC");
			$entriesToPublish = $this->NewsEntry->find('all',$options);
			$this->set('entriesToPublish',$entriesToPublish);
		}
	}
	
	/*public function editNews($newsEntryId = null){
		$newsblogPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsblogPlugin['Plugin']['id'];
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Edit');
		if($editAllowed){
			$this->autoLayout = true;
			$this->layout = 'overlay';
			//load current data of newsentry with id = $newsEntryId
			$entry = $this->NewsEntry->findById($newsEntryId);
			//send data to view
			$this->set('newsentry', $entry);
		} else{
			$this->Session->setFlash("Action not allowed!");
			$this->redirect($this->referer());
		}
	}*/
}