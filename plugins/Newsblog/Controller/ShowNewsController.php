<?php
class ShowNewsController extends AppController{
	var $autoLayout = false;
	public $helpers = array('Html');
	public $components = array('Menu', 'RequestHandler');
	
	public function admin($contentId = null){
		$this->autoLayout = true;
		$this->layout = 'fancybox';
		$this->loadModel('Newsblog.NewsEntry');
		
		$this->loadModel('Plugin');
		$newsblogPlugin = $this->Plugin->findByName('Newsblog');
		$pluginId = $newsblogPlugin['Plugin']['id'];
		$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
		if($publishAllowed){
			$conditions = array("NewsEntry.published" => false, "NewsEntry.deleted !=" => true);
				
			$this->NewsEntry->bindModel(
				array('belongsTo' => array(
					'User' => array(
						'className' => 'User',
						'foreignKey' => 'author_id'
					)
				))
			);
			
			$options['conditions'] = $conditions;
			$options['order'] = array("createdOn DESC");
			$entriesToPublish = $this->NewsEntry->find('all',$options);
			$this->set('entriesToPublish',$entriesToPublish);
		}
	}
	
	public function editNews($newsEntryId = null){
		$this->loadModel('Plugin');
		$newsblogPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsblogPlugin['Plugin']['id'];
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Edit');
		if($editAllowed){
			$this->autoLayout = true;
			$this->layout = 'fancybox';
			//load current data of newsentry with id = $newsEntryId
			$this->loadModel('Newsblog.NewsEntry');
			$entry = $this->NewsEntry->findById($newsEntryId);
			//send data to view
			$this->set('newsentry', $entry);
		} else{
			$this->redirect($this->referer());
		}
	}
	
	public function deleteNews($newsEntryId = null){
		$userId = $this->Auth->user('id');
		$this->loadModel('Plugin');
		$newsblogPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsblogPlugin['Plugin']['id'];
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Delete');
		if ($deleteAllowed){
			$this->loadModel('Newsblog.NewsEntry');
			$this->NewsEntry->id = $newsEntryId;
			$newsEntry = array();
			$newsEntry['deleted'] = true;
			
			if($this->NewsEntry->save($newsEntry)){
				$this->redirect($this->referer());
			} else{
				
			}
		} else{
			$this->redirect($this->referer());
		}
	}
	
	public function saveNewsData(){
		if ($this->RequestHandler->request->is('ajax')) {
			//configure for response with a json object
			$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->RequestHandler->response->type('json','application/json');
			//get plugin and check for required permissions
			$userId = $this->Auth->user('id');
			$this->loadModel('Plugin');
			$newsblogPlugin = $this->Plugin->findByName($this->plugin);
			$pluginId = $newsblogPlugin['Plugin']['id'];
			$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write');
			$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Edit');
			//load NewsEntry Model
			$this->loadModel('Newsblog.NewsEntry');
			//get request data and read it in variables
			$data = $this->RequestHandler->request->data;
			$action = $data['action'];
			$id = null;
			if(isset($data['id'])){
				$id = $data['id'];
			}
			$id = $data['id'];
			$content_id = null;
			if(isset($data['content_id'])){
				$content_id = $data['content_id'];
			}
			
			$title = $data['title'];
			$text = $data['text'];
			$validFrom = $data['validFrom'];
			$validTo = $data['validTo'];
			//message for response on the ajax call
			$message = null;
			switch ($action) {
				case 'createNews':
					if($writeAllowed){
						$newNews = array();
						$this->NewsEntry->create();
						//set data in array
						$newNews['title'] = $title;
						$newNews['text'] = $text;
						$newNews['content_id'] = $content_id;
						$newNews['author_id'] = $userId;
						$newNews['createdOn'] = date('Y-m-d H:i:s');
						$newNews['validFrom'] = $validFrom;
						$newNews['validTo'] = $validTo;
						$newNews['published'] = false;
						//save array on database
						if($this->NewsEntry->save($newNews)){
							$message = json_encode(array('success' => true, 'action' => 'createNews', 'data' => $newNews));
						} else{
							$message = json_encode(array('success' => false, 'action' => 'createNews', 'data' => $newNews));
						}
					} else{
			
					}
					break;
				case 'editNews':
					if($editAllowed){
						$newNews = array();
						//set id to update newsentry
						$this->NewsEntry->id = $id;
						//set data in array
						$newNews['id'] = $id;
						$newNews['title'] = $title;
						$newNews['text'] = $text;
						$newNews['lastModifiedBy'] = $userId;
						$newNews['lastModifiedOn'] = date('Y-m-d H:i:s');
						$newNews['validFrom'] = $validFrom;
						$newNews['validTo'] = $validTo;
						//save array on database
						if($this->NewsEntry->save($newNews)){
							$message = json_encode(array('success' => true, 'action' => 'editNews', 'data' => $newNews));
						} else{
							$message = json_encode(array('success' => false, 'action' => 'editNews', 'data' => $newNews));
						}
					} else{
						
					}
					break;
				default:
					
					break;
			}
			
			echo $message;
			exit();
		} else{
			var_dump($this->RequestHandler->request);
			$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;
			echo "true";
			exit();
		}
	}
	
	public function publishNews($newsEntryId = null){
		if ($this->RequestHandler->request->is('ajax')) {
			//configure for response with a json object
			$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->RequestHandler->response->type('json','application/json');
			//get data of request
			$requestData = $this->RequestHandler->request->data;
			$newsEntryId = $requestData['id'];
			//get plugin and check for required permissions
			$userId = $this->Auth->user('id');
			$this->loadModel('Plugin');
			$newsblogPlugin = $this->Plugin->findByName($this->plugin);
			$pluginId = $newsblogPlugin['Plugin']['id'];
			$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
			
			$message;
			if ($publishAllowed){
				$this->loadModel('Newsblog.NewsEntry');
				$this->NewsEntry->id = $newsEntryId;
				$publishNews = array();
				$publishNews['published'] = true;
				$publishNews['publishedBy'] = $userId;
				$publishNews['publishedOn'] = date('Y-m-d');
				
				if ($this->NewsEntry->save($publishNews)){
					$publishNews['id'] = $newsEntryId;
					$message = json_encode(array('success' => true, 'action' => 'publishNews', 'data' => $publishNews));
				} else{
					$message = json_encode(array('success' => false, 'action' => 'publishNews', 'data' => $publishNews));
				}
				
			} else{
				$message = json_encode(array('success' => false, 'action' => 'publishNews', 'data' => 'Action not allowed!'));
			}
			echo $message;
			exit();
		} else{
			
		}
	}
	
	public function saveNewsblogTitle($content_id = null, $newsblogTitle = null){
		if ($this->RequestHandler->request->is('ajax')) {
			//configure for response with a json object
			$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->RequestHandler->response->type('json','application/json');
			//get data of request
			$requestData = $this->RequestHandler->request->data;
			$newsblogTitle = $requestData['newsblogTitle'];
			$content_id = $requestData['content_id'];
			
			$this->loadModel('Newsblog.NewsblogTitle');
			$newsblogTitleFromDB = $this->NewsblogTitle->find('first', array('conditions' => array('content_id' => $content_id)));
			$this->NewsblogTitle->id = $newsblogTitleFromDB['NewsblogTitle']['id'];
			$newsblogTitleFromDB['NewsblogTitle']['title'] = $newsblogTitle;
			
			$message;
			if($this->NewsblogTitle->save($newsblogTitleFromDB['NewsblogTitle'])){
				$message = json_encode(array('success' => true, 'action' => 'storeNewsblogTitle', 'data' => $newsblogTitleFromDB['NewsblogTitle']));
			} else{
				$message = json_encode(array('success' => false, 'action' => 'storeNewsblogTitle', 'data' => $newsblogTitleFromDB['NewsblogTitle']));
			}
			echo $message;
			exit();
		} else{
			
		}
	}
}