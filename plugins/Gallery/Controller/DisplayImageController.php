<?php
class DisplayImageController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.GalleryPictureComp');
	
	public function admin($contentId){
		//debug($contentId);
		
		$this->redirect(array('action' => 'setImageAdminTab', $contentId));
	}
	
	public function setImageAdminTab($contentId){
		$this->layout = 'overlay';
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
								'ContentId' => $contentId
		);
		
		$this->set('data',$data);
	}
	
	public function setImage($contentId, $pictureId){
		//debug("setImage:".$contentId." ".$pictureId);
		$this->ContentValueManager->saveContentValues($contentId, array('pictureID' => $pictureId));
		
		$this->Session->setFlash('Image sucessfully assigned');
		
		$this->redirect($this->referer());
	}
	
}