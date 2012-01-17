<?php
class DisplayImageController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.GalleryPicture');
	var $layout = 'overlay';
	
	public function admin($contentId){
		//debug($contentId);
		
		$this->redirect(array('action' => 'setImageAdminTab', $contentId));
	}
	
	public function setImageAdminTab($contentId){
		$allPics = $this->GalleryPicture->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
								'ContentId' => $contentId
		);
		
		$this->set('data',$data);
	}
	
	public function setImage($contentId, $pictureId){
		//debug("setImage:".$contentId." ".$pictureId);
		$this->ContentValueManager->saveContentValues($contentId, array('pictureID' => $pictureId));
		$this->redirect($this->referer());
	}
	
}