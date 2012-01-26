<?php
class ManageImagesController  extends GalleryAppController{
	var $layout = 'overlay';
	
	public $components = array('Gallery.GalleryPictureComp');
	
	
	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
	
    
	/**
	 * Need to pass the content id -> user could switch back to the set set image tab
	 * @param int $contentId
	 */
	public function index($contentId){
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
						'ContentId' => $contentId );
		
		$this->set('data',$data);
	}
	
	
	/**
	 * Method is called from the add image form
	 * transforms the form input for internal procession
	 * Enter description here ...
	 */

	public function uploadImage($contentId){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);

		$image = array('name' => $this->data['addImage']['File']['name'],
								'tmp_name' => $this->data['addImage']['File']['tmp_name'],
								'size' => $this->data['addImage']['File']['size'],
								'title' => $this->data['addImage']['Title']);
		$this->addImageInternal($image);
		$this->Session->setFlash('Image saved');
		
		$this->redirect($this->referer());
	}
	
	/**
	 * Method is called from the add images form
	 * transforms the form input for internal procession
	 */
	public function uploadImages($contentId){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);

		for($i = 0;$i<count($this->params['form']['files']['name']);$i++){
			$image = array('name' => $this->params['form']['files']['name'][$i],
							'tmp_name' => $this->params['form']['files']['tmp_name'][$i],
							'size' => $this->params['form']['files']['size'][$i],
							'title' => $this->params['form']['files']['name'][$i]
			);
			$this->addImageInternal($image);
		}
		
		$this->Session->setFlash('Images saved');
		
		$this->redirect($this->referer());
		
	}
	
	public function create($contentId){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
		
		$data = array('ContentId' => $contentId );
		$this->set('data',$data);
	}
	
	/**
	 * processes a new uploaded umade
	 * Structure:
	 * Image:
	 * 	[name]
	 * 	[tmp_name]
	 * 	[size]
	 * 	[title]
	 * @param unknown_type $image
	 */
	private function addImageInternal($image){
		
		$dest = realpath("../../app/webroot/img/gallery").'/'.$image['name'];
		
		$image_source = imagecreatefromjpeg($image['tmp_name']);
		
		$exif = exif_read_data($image['tmp_name']);
		
		// Output
		imagejpeg($image_source,$dest, 100);
		
		// save to db
		$dbImage = array(
					'title' => $image['title'],
					'path_to_pic' => "/app/webroot/img/gallery/".$image['name'] );
		
		$this->GalleryPictureComp->generateThumbnail($dbImage);
		$this->GalleryPictureComp->save($this,$dbImage);
	}
	
	public function delete($pictureId, $contentId){
		
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$this->deletePictureInternal($pictureId);
		$this->Session->setFlash('Image deleted');
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentId){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		
		foreach($this->data['selectPictures'] as $imageId => $toBeDeleted){
			if($toBeDeleted == 1){
				$this->deletePictureInternal($imageId);
			}
		}
		$this->Session->setFlash('Images deleted');
		$this->redirect($this->referer());
	}
	
	private function deletePictureInternal($pictureID){
		$picture = $this->GalleryPictureComp->delete($this,$pictureID);
	}

	public function edit($pictureId,$contentId){
		
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		
		
		$picture = $this->GalleryPictureComp->getPicture($this,$pictureId);
		
		$data = array(	'Picture' => $picture,
						'ContentId' => $contentId );
		
		$this->set('data',$data);		
	}
	
	public function save($contentId){
		$this->GalleryPictureComp->save($this,$this->data['GalleryPicture']);
		$this->redirect(array('action' => 'index', $contentId));
	}
	
}