<?php
App::uses('GalleryAppController', 'Gallery.Controller');

class SimpleImageDisplayController extends GalleryAppController {
	
	public $components = array('ContentValueManager');
	public $uses = array('Gallery.GalleryPicture');

    public function admin($contentId)
    {
        $this->layout = 'overlay';
		$this->set('contentId', $contentId);
    }
    
	public function index($contentId){
        $this->layout = 'overlay';
		$existingImages = $this->GalleryPicture->find('all');
		//debug($existingImages);
		$this->set('allImages', $existingImages);
		$this->set('contentId', $contentId);
	}
	
	public function setImage($contentId,$pictureId){
		debug($contentId);
		debug($pictureId);
		debug($this->ContentValueManager->saveContentValues($contentId, array('pictureID' => $pictureId)));
		$this->redirect(array('action' => 'admin', $contentId));
	
		//$this->redirect(array('action' => 'admin', $contentID));
	}
}
