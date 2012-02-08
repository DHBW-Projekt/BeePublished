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
 * @author Alexander Müller & Fabian Kajzar
 * 
 * @description Controller to manage all operations relating galleries
 */

class ManageGalleriesController  extends GalleryAppController{
	public $layout = 'overlay';
	
	public $components = array('Gallery.Gallery','Gallery.GalleryPictureComp');
	
	/* (non-PHPdoc)
	 * @see Controller::beforeRender()
	 */
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
	 * @param string $menue_context
	 */
	public function index($contentId, $menue_context){	
				
		$allGalls= $this->Gallery->getAllGalleries($this);
		
		$data = array(	'AllGalleries' => $allGalls);
		
		if (! $this->request->is('post')) {
			$pic_array = array();
			$index = 0;
			foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
					
				$pic_array[$picture['id']] = $picture['title'];
				$index++;
			}
		}
				
		$this->set('data',$data);
		$this->set('pictures', $pic_array);
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
	}	
	/**
	 * Function related the create View (to create a new Gallery)
	 * @param int $contentId
	 * @param string $menue_context
	 */
	public function create($contentId, $menue_context){

		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
		//check whether in put is poast
		if (! $this->request->is('post')) {
		$pic_array = array();
		$index = 0;
		//build up array for titlepic drop down
		foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
			
			$pic_array[$picture['id']] = $picture['title'];
			$index++;
		}
		
		$this->set('ContentId',$contentId);
		$this->set('pictures', $pic_array);
		$this->set('mContext',$menue_context);
		} else {
			$this->loadModel('Gallery.GalleryEntry');
			if (!empty($this->request->data)) {
				//check whether title picture isset
				if($this->request->data['GalleryEntry']['gallery_picture_id'] == null){
					
					$this->Session->setFlash(__d('gallery', 'Your Gallery was not saved. You have to assign a title picture'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId,$menue_context));
				}else {
					//check if parameters are set

					if(!empty($this->request->data['GalleryEntry']['title']) || !empty($this->request->data['GalleryEntry']['description'])){
						if($this->GalleryEntry->save($this->request->data)) {
							
							$this->Session->setFlash(__d('gallery', 'Your Gallery was saved.'), 'default', array('class' => 'flash_success'));
							$this->redirect(array('action' => 'index', $contentId,$menue_context));	
						} else {
							$this->Session->setFlash(__d('gallery', 'Your Gallery was not saved.'), 'default', array('class' => 'flash_failure'));
							$this->redirect(array(	'action' => 'index', $contentId,$menue_context));		
						}	
					} else {
						$this->Session->setFlash(__d('gallery', 'Your Gallery was not saved. You have to assign a title and a description to your gallery.'), 'default', array('class' => 'flash_failure'));
						$this->redirect(array(	'action' => 'create', $contentId,$menue_context));		
					}//check data
				}		
    		}//data empty
		}// is post
	}//function
	
	/**
	 * deletes a gallery
	 * @param int $galleryId
	 * @param int $contentId
	 * @param string $menue_context
	 */
	public function delete($galleryId, $contentId, $menue_context){
	
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		$picture = $this->Gallery->delete($this,$galleryId);
		$this->set('mContext',$menue_context);
		$this->redirect($this->referer());
	}
	
	/**
	 * deletes a List of Galleries
	 * @param int $contentId
	 */
	public function deleteSelected($contentId, $menue_context){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		$deleteditems = -1;
		$this->set('mContext',$menue_context);
		if ($this->request->is('post')){
		
			$galleries=  $this->Gallery->getAllGalleries($this);
			if(isset($this->data['selectGalleries'])) {
				$selectedGalleries = $this->data['selectGalleries'];
			
				
				foreach($galleries as $gallery){
					$id = $gallery['GalleryEntry']['id'];
					//check whether deleted are set
					if ($selectedGalleries[$id] == 1){
						$this->Gallery->delete($this,$id);
						$deleteditems++;
					}
				}
				//notify
				if(! ($deleteditems <=0)){
					$this->Session->setFlash(__d('gallery', 'Deleted sucessfully'), 'default', array('class' => 'flash_success'),'GalleryNotification');
				}//if
			} else {
					$this->Session->setFlash(__d('gallery', 'Nothing selected.'), 'default', array('class' => 'flash_failure'),'GalleryNotification');
			}//else
			
			$this->redirect($this->referer());
		}//if is post
	
	}//function delete selected
	
	/**
	 * Allows to Edit Galleries, related to Edit view
	 * @param id $galleryId
	 * @param id $contentId
	 * @param id $menue_context 
	 */
	public function edit($galleryId,$contentId, $menue_context){
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		
		if ($this->request->is('post')) {
				if($this->Gallery->save($this,$this->request->data)) {
					$this->Session->setFlash(__d('gallery', 'Your changes were saved!'), 'default', array('class' => 'flash_success'));
					//redirect 
					$this->redirect(array('action' => 'index', $contentId,$menue_context));	
				} else {
					$this->Session->setFlash(__d('gallery', 'Your Gallery was not saved'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId,$menue_context));		
				}//else
				$this->redirect($this->referer());
		}
		//if no post data isset
		
		$gallery = $this->Gallery->getGallery($this,$galleryId);
		$this->set('data',$gallery);
		$this->set('ContentId',$contentId);	
		$this->set('mContext',$menue_context);	
		
		// set title picture
		$pic_array = array();
		$index = 0;
		foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
				
			$pic_array[$picture['id']] = $picture['title'];
			$index++;
		}
		$this->set('pictures', $pic_array);
		
	}
	
	/**
	 * Method related to the View for assigning images to a gallery
	 * @param int $galleryId
	 * @param int $contentId
	 * @param int $menuecontext
	 */
	public function assignImages($galleryId,$contentId, $menue_context){
			$pluginId = $this->getPluginId();
			$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
			$this->set('available_pictures',$this->GalleryPictureComp->getAllUnAssignedPictures($this));
			$this->set('gallery_pictures',$this->GalleryPictureComp->getAllPicturesGallery($this, $galleryId));
			$this->set('galleryId', $galleryId);
			$this->set('ContentId',$contentId);
			$this->set('mContext',$menue_context);
		
	}
	
	/**
	 * Assigns an image to the specified Gallery
	 * @param int $galleryId
	 * @param int $pictureId
	 * @param int $menuecontext
	 */
	public function assignImage($galleryId,$pictureId, $menue_context){
		//get pictures
		$picture = $this->GalleryPictureComp->getPicture($this, $pictureId);
		
		if($picture['gallery_entry_id'] == null){
			$picture['gallery_entry_id'] = $galleryId;
		}else{
			$picture['gallery_entry_id'] = null;
		}

		$this->GalleryPictureComp->save($this,$picture);
		$this->set('mContext',$menue_context);
		$this->redirect($this->referer());
	}
	
	/**
	 * Ressigns an image to the specified Gallery
	 * @param int $galleryId
	 * @param int $pictureId
	 * @param int $menuecontext
	 */
	public function unassignImage($galleryId,$pictureId,$menue_context){
		$picture = $this->GalleryPictureComp->getPicture($this, $pictureId);
		
		$picture['gallery_entry_id'] = null;
		
		$this->GalleryPictureComp->save($this,$picture);
		$this->set('mContext',$menue_context);
		$this->redirect($this->referer());
	}

}