<?php
App::uses('NewsblogAppController', 'Newsblog.Controller');
/**
 * NewsEntries Controller
 *
 * @property NewsEntry $NewsEntry
 */
class NewsEntriesController extends NewsblogAppController {
	public $uses = array('Newsblog.NewsEntry');
	
	public function create($contentId = null){
		$pluginId = $this->getPluginId();
		$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write', true);
		$userId = $this->Auth->user('id');
		if(!($this->request->is('post') || $this->request->is('put'))){
			$this->layout = 'overlay';
			$this->set('pluginId', $pluginId);
			$this->set('contentId', $contentId);
			$this->set('webroot', $this->webroot);
		} else{
			$data = $this->request->data;
			$now = date('Y-m-d H:i:s');
			$title = $data['title'];
			$subtitle = $data['subtitle'];
			$text = $data['text'];
			$validFrom = $data['validFrom'];
			if($validFrom == "" || $validFrom == null){
				$validFrom = $now;
			}
			$validTo = $data['validTo'];
			if($validTo == "" || $validTo == null){
				$validTo = '9999-12-31 23:59:59';
			}
			$contentId = $data['contentId'];
		
			$newNews = array();
			$this->NewsEntry->create();
			//set data in array
			$newNews['title'] = $title;
			$newNews['subtitle'] = $subtitle;
			$newNews['text'] = $text;
			$newNews['content_id'] = $contentId;
			$newNews['author_id'] = $userId;
			$newNews['createdOn'] = $now;
			$newNews['validFrom'] = $validFrom;
			$newNews['validTo'] = $validTo;
			$newNews['published'] = false;
			//save array on database
			if($this->NewsEntry->save($newNews)){
				$this->Session->setFlash("The news has been created! It has to be published!");
				$this->redirect(array('action' => 'create', $contentId));
			} else{
				$this->Session->setFlash("The news hasn\'t been created!");
				$this->redirect(array('action' => 'create', $contentId));
			}
		}
	}
	
	public function edit($id = null){
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Edit', true);
		$userId = $this->Auth->user('id');
		if($this->request->is('get')){
			$this->layout = 'overlay';
			//load current data of newsentry with id = $newsEntryId
			$entry = $this->NewsEntry->findById($id);
			//send data to view
			$this->set('newsentry', $entry);
		} elseif($this->request->is('post') || $this->request->is('put')){
			$data = $this->request->data;
			$now = date('Y-m-d H:i:s');
			$title = $data['title'];
			$subtitle = $data['subtitle'];
			$text = $data['text'];
			$validFrom = $data['validFrom'];
			if($validFrom == "" || $validFrom == null){
				$validFrom = $now;
			}
			$validTo = $data['validTo'];
			if($validTo == "" || $validTo == null){
				$validTo = '9999-12-31 23:59:59';
			}
			$action = $data['action'];
			$id = $data['id'];
			$changedNews = array();
			$this->NewsEntry->id = $id;
			//set data in array
			$changedNews['title'] = $title;
			$changedNews['text'] = $text;
			$changedNews['subtitle'] = $subtitle;
			$changedNews['lastModifiedBy'] = $userId;
			$changedNews['lastModifiedOn'] = $now;
			$changedNews['validFrom'] = $validFrom;
			$changedNews['validTo'] = $validTo;
			
			
			//save array on database
			if($this->NewsEntry->save($changedNews)){
				$this->Session->setFlash("The changes have been saved!");
				$this->redirect($this->referer());
			} else{
				$this->Session->setFlash("The changes haven\'t been saved!");
				$this->redirect($this->referer());
			}
		}
	}
	
	public function publish($contentId = null, $newsEntryId = null){
		$pluginId = $this->getPluginId();
		$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish', true);
		
		if($this->request->is('post')) {
			$newsEntryId = $this->request->data['id'];
			$contentId = $this->request->data['contentId'];
		}
		
		if($newsEntryId == null){
			$this->layout = 'overlay';
			
			
			$this->set('pluginId', $pluginId);
			$this->set('contentId', $contentId);
			$this->set('webroot', $this->webroot);
			$conditions = array("NewsEntry.content_id" => $contentId, "NewsEntry.published !=" => true, "NewsEntry.deleted !=" => true);
			
			$options['conditions'] = $conditions;
			$options['order'] = array("createdOn DESC");
			$entriesToPublish = $this->NewsEntry->find('all',$options);
			$this->set('entriesToPublish',$entriesToPublish);
		} else{
			//get plugin and check for required permissions
			$userId = $this->Auth->user('id');
			
			$this->NewsEntry->id = $newsEntryId;
			$publishNews = array();
			$publishNews['published'] = true;
			$publishNews['publishedBy'] = $userId;
			$publishNews['publishedOn'] = date('Y-m-d');
			
			if ($this->NewsEntry->save($publishNews)){
				$this->Session->setFlash("The selected news has been published.");
			} else{
				$this->Session->setFlash("The selected news hasn\'t been published.");
			}
			
			$this->redirect(array('action' => 'publish', $contentId));
		}
	}
	
	public function delete($id = null){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Delete', true);
		
		$userId = $this->Auth->user('id');
		//get news entry id if it is a ajax call or post request
		if($this->request->is('post')){
			$id = $this->request->data['id'];
		}
		
		$this->NewsEntry->id = $id;
		if($this->NewsEntry->saveField('deleted', true)){
			$this->Session->setFlash('The selected news has been deleted.');
			$this->redirect($this->referer());
		} else{
			$this->Session->setFlash('The selected news hasn\'t been deleted.');
			$this->redirect($this->referer());
		}
	}

}