<?php
class ManageGalleriesController  extends GalleryAppController{
	public $layout = 'overlay';
	
	public $components = array('Gallery.Gallery','Gallery.GalleryPictureComp');
	
	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
	
	
	/**
	 * Index function, to list all available Galleries
	 * @param int $contentId
	 */
	public function index($contentId){
		
		$allGalls= $this->Gallery->getAllGalleries($this);
		
		$data = array(	'AllGalleries' => $allGalls,
						'ContentId' => $contentId );
		$pic_array = array();
		$index = 0;
		foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
			
			$pic_array[$index] = array($picture['id'] =>  $picture['id']);
			$index++;
		}
		
		$this->set('data',$data);
		$this->set('pictures', $pic_array);
	}	
	/**
	 * Function related the create View (to create a new Gallery)
	 * @param int $contentId
	 */
	public function create($contentId){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		

		if (! $this->request->is('post')) {
		$data = array( 'ContentId' => $contentId );
		$pic_array = array();
		$index = 0;
		foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
			
			$pic_array[$picture['id']] = $picture['title'];
			$index++;
		}
		
		$this->set('data',$data);
		$this->set('pictures', $pic_array);
		
		} else {
			$this->loadModel('Gallery.GalleryEntry');
			if (!empty($this->request->data)) {
				debug($this->request->data);
				if($this->request->data['GalleryEntry']['gallery_picture_id'] == null){
					
				
				//if(! array_key_exists('gallery_picture_id', $this->request->data)){
					$this->Session->setFlash(__('Your Gallery was not saved. You have to assign a title picture'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId));
				}else {
					if($this->GalleryEntry->save($this->request->data)) {
						$this->Session->setFlash(__('Your Gallery was saved.'), 'default', array('class' => 'flash_success'));
						$this->redirect(array('action' => 'index', $contentId));	
					} else {
						$this->Session->setFlash(__('Your Gallery was not saved.'), 'default', array('class' => 'flash_failure'));
						$this->redirect(array(	'action' => 'index', $contentId));		
					}
				}		
    		}//data empty
		}// is post
	}//function
	
	/**
	 * deletes a gallery
	 * @param int $galleryId
	 * @param int $contentId
	 */
	public function delete($galleryId, $contentId){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$picture = $this->Gallery->delete($this,$galleryId);
		$this->redirect($this->referer());
	}
	
	/**
	 * deletes a List of Galleries
	 * @param int $contentId
	 */
	public function deleteSelected($contentId){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		if ($this->request->is('post')){
			$galleries=  $this->Gallery->getAllGalleries($this);
			
			$selectedGalleries = $this->data['selectGalleries'];
			foreach($galleries as $gallery){
				$id = $gallery['GalleryEntry']['id'];
				if ($selectedGalleries[$id] == 1){
					$this->Gallery->delete($this,$id);
				}
			}
			$this->redirect($this->referer());
		}
	}//function delete selected
	
	/**
	 * Allows to Edit Galleries, related to Edit view
	 * @param id $galleryId
	 * @param id $contentId
	 */
	public function edit($galleryId,$contentId){
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		
		if ($this->request->is('post')) {
				if($this->Gallery->save($this,$this->request->data)) {
					$this->Session->setFlash(__('Your changes were saved!'), 'default', array('class' => 'flash_success'));
					//redirect 
					$this->redirect(array('action' => 'index', $contentId));	
				} else {
					$this->Session->setFlash(__('Your Gallery was not saved'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId));		
				}
				//$this->redirect($this->referer());
		}
		//if no post data isset
		
		$gallery = $this->Gallery->getGallery($this,$galleryId);
		$this->set('data',$gallery);
		$this->set('ContentId',$contentId);		
	}
	
	/**
	 * Method related to the View for assigning images to a gallery
	 * @param int $galleryId
	 * @param int $contentId
	 */
	public function assignImages($galleryId,$contentId){
			$pluginId = $this->getPluginId();
			$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
			$this->set('available_pictures',$this->GalleryPictureComp->getAllUnAssignedPictures($this));
			$this->set('gallery_pictures',$this->GalleryPictureComp->getAllPicturesGallery($this, $galleryId));
			$this->set('galleryId', $galleryId);
			$this->set('ContentId',$contentId);
		
	}
	
	/**
	 * Assigns an image to the specified Gallery
	 * @param int $galleryId
	 * @param int $pictureId
	 */
	public function assignImage($galleryId,$pictureId){
		$picture = $this->GalleryPictureComp->getPicture($this, $pictureId);
		
		if($picture['gallery_entry_id'] == null){
			$picture['gallery_entry_id'] = $galleryId;
		}else{
			$picture['gallery_entry_id'] = null;
		}

		$this->GalleryPictureComp->save($this,$picture);
		$this->redirect($this->referer());
	}
	
	/**
	 * Ressigns an image to the specified Gallery
	 * @param int $galleryId
	 * @param int $pictureId
	 */
	public function unassignImage($galleryId,$pictureId){
		$picture = $this->GalleryPictureComp->getPicture($this, $pictureId);
		
		$picture['gallery_entry_id'] = null;
		
		$this->GalleryPictureComp->save($this,$picture);
		$this->redirect($this->referer());
	}

}