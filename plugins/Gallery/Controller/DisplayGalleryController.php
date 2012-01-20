<?php
class DisplayGalleryController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.Gallery');
	var $layout = 'overlay';
	
	public function admin($contentId){
		//debug($contentId);
		
		$this->redirect(array('action' => 'setGalleryAdminTab', $contentId));
	}
	
	public function setGalleryAdminTab($contentId){
		$allGalleries = $this->Gallery->getAllGalleries($this);
		
		debug($allGalleries);
		
		$data = array(	'AllGalleries' => $allGalleries,
								'ContentId' => $contentId
		);
		
		$this->set('data',$data);
	}
	
	public function setGallery($contentId, $galleryId){
		//debug("setImage:".$contentId." ".$pictureId);
		$this->ContentValueManager->saveContentValues($contentId, array('galleryID' => $galleryId));
				
		$this->redirect($this->referer());
	}
	
}