<?php
class DisplayImageController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.GalleryPictureComp');
	
	public function admin($contentId){		
		$this->redirect(array('action' => 'setImageAdminTab', $contentId,'singleImage'));
		
	}
	
	public function setImageAdminTab($contentId,$menue_context){
		$this->layout = 'overlay';
		$currentlyassigned =  $this->ContentValueManager->getContentValues($contentId);
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
						'CurrPicture' => $currentlyassigned );
		
		$this->set('data',$data);
		$this->set('mContext',$menue_context);	
		$this->set('ContentId',$contentId);
	}
	
	public function setImage($contentId, $pictureId, $menue_context){
		$this->ContentValueManager->saveContentValues($contentId, array('pictureID' => $pictureId));
		
		$this->Session->setFlash('Image sucessfully assigned');
		$this->set('mContext',$menue_context);	
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	
}