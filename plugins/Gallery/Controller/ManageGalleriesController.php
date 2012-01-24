<?php

class ManageGalleriesController  extends AppController{
	public $layout = 'overlay';
	
	public $components = array('Gallery.Gallery','Gallery.GalleryPictureComp');
	
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
	public function create($contentId){
		//debug($this->request->data);
		if (! $this->request->is('post')) {
		$data = array( 'ContentId' => $contentId );
		$pic_array = array();
		$index = 0;
		foreach( $this->GalleryPictureComp->getAllPictures($this) as $picture){
			
			$pic_array[$index] = array($picture['id'] =>  $picture['id']);
			$index++;
		}
		
		$this->set('data',$data);
		$this->set('pictures', $pic_array);
		
		} else {
		
			$this->loadModel('Gallery.GalleryEntry');
		
			if (!empty($this->request->data)) {
				
				if($this->GalleryEntry->save($this->request->data)) {
					$this->Session->setFlash(__('Your post was saved. It will be released by an administrator.'), 'default', array('class' => 'flash_success'));
					//redirect 
					$this->redirect(array('action' => 'index', $contentId));	
				} else {
					$this->Session->setFlash(__('Your Gallery was not saved'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId));		
				}			
    		}//data empty
		}// is post
	}//function
	
	public function delete($galleryId, $contentId){
		$picture = $this->Gallery->delete($this,$galleryId);
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentId){
		if ($this->request->is('post')){
			$galleries=  $this->Gallery->getAllGalleries($this);
			
			$selectedGalleries = $this->data['selectGalleries'];
			debug ($selectedGalleries);
			foreach($galleries as $gallery){
				$id = $gallery['GalleryEntry']['id'];
				if ($selectedGalleries[$id] == 1){
					$this->Gallery->delete($this,$id);
				}
			}
			$this->redirect($this->referer());
		}
	}//function delete selected
	
	public function edit($galleryId,$contentId){
		if ($this->request->is('post')) {
				//debug($this->request->data);
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
		//debug($gallery);
		
	}
	
	public function save($contentId){
	
	}
	
	public function assignImages($galleryId,$contentId){
			
			$this->set('available_pictures',$this->GalleryPictureComp->getAllUnAssignedPictures($this));
			$this->set('gallery_pictures',$this->GalleryPictureComp->getAllPicturesGallery($this, $galleryId));
			$this->set('galleryId', $galleryId);
			$this->set('ContentId',$contentId);
		
	}
	
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
	
	public function unassignImage($galleryId,$pictureId){
		$picture = $this->GalleryPictureComp->getPicture($this, $pictureId);
		
		$picture['gallery_entry_id'] = null;
		
		$this->GalleryPictureComp->save($this,$picture);
		$this->redirect($this->referer());
	}

}