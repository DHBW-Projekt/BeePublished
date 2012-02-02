<?php
class DisplayGalleryController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.Gallery','Gallery.GalleryPictureComp');
	var $layout = 'overlay';
	
	public function index($galleryId){
		$this->redirect(array('controller' => 'DisplayGallery', 'action' => 'index'));
	}
	
	public function admin($contentId){
		$this->redirect(array('action' => 'setGalleryAdminTab', $contentId));
	}
	
	public function setGalleryAdminTab($contentId){
		$allGalleries = $this->Gallery->getAllGalleries($this);

		$data = array(	'AllGalleries' => $allGalleries,
						'ContentId' => $contentId
		);
		
		$this->set('data',$data);
	}
	
	public function setGallery($contentId, $galleryId){
		$this->ContentValueManager->saveContentValues($contentId, array('galleryID' => $galleryId));

		$this->Session->setFlash('Gallery sucessfully assigned');
		
		$this->redirect($this->referer());
	}
	

}