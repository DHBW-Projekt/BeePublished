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
		$this->loadModel('Gallery.GalleryEntry');
		
		if (!empty($this->request->data)) {
			if ($this->request->is('post')) {
				if($this->GalleryEntry->save($this->request->data)) {
					$this->Session->setFlash(__('Your post was saved. It will be released by an administrator.'), 'default', array('class' => 'flash_success'));
					//redirect 
					$this->redirect(array('action' => 'index', $contentId));	
				} else {
					$this->Session->setFlash(__('Your Gallery was not saved'), 'default', array('class' => 'flash_failure'));
					$this->redirect(array(	'action' => 'index', $contentId));		
				}
				
			}	
			
        // We can save the User data:
        // it should be in $this->request->data['User']

    

        // If the user was saved, Now we add this information to the data
        // and save the Profile.

     /*   if (!empty($user)) {
            // The ID of the newly created user has been set
            // as $this->User->id.
            $this->request->data['Profile']['user_id'] = $this->User->id;

            // Because our User hasOne Profile, we can access
            // the Profile model through the User model:
            $this->User->Profile->save($this->request->data);
        }*/
    	}
	}
	
	public function delete($galleryId, $contentId){
		$picture = $this->Gallery->delete($this,$galleryId);
		
		//$this->redirect($this->referer());
	}

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
		
		$picture['gallery_entry_id'] = $galleryId;
		
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