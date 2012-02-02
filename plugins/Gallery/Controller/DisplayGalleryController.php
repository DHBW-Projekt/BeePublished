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
	
	public function setGalleryAdminTab($contentId, $menue_context){
		$currentlyassigned =  $this->ContentValueManager->getContentValues($contentId);
		
		$allGalleries = $this->Gallery->getAllGalleries($this);

		$data = array(	'AllGalleries' => $allGalleries,
						'ContentId' => $contentId,
						'CurrGallery' => $currentlyassigned
		);
		
		$this->set('data',$data);
		$this->set('mContext','singleGallery');
	}
	
	public function setGallery($contentId, $galleryId, $menue_context){
		$this->ContentValueManager->saveContentValues($contentId, array('galleryID' => $galleryId));

		$this->Session->setFlash('Gallery sucessfully assigned');
		$this->set('mContext','singleGallery');
		$this->redirect($this->referer());
	}
	

}