<?php
class DisplayGalleryController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.Gallery','Gallery.GalleryPictureComp');
	var $layout = 'overlay';
	
	public function admin($contentId){
		//debug($contentId);		
		$this->redirect(array('action' => 'setGalleryAdminTab', $contentId));
	}
	
	public function setGalleryAdminTab($contentId){
		$allGalleries = $this->Gallery->getAllGalleries($this);
		
		//debug($allGalleries);
		
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
	
	public function displaySingleImage($galleryId, $imageId){
		$gallery = $this->Gallery->getGallery($this,$galleryId);
		
		$pictures = $gallery['GalleryPicture'];
		
		for($i = 0;$i<sizeof($pictures);$i++){
			if($pictures[$i]['id'] == $imageId){
				$displayPosition = $i;
				$previous = $displayPosition -1;
				$next = $displayPosition +1;
			}
		}
		
		$data['GalleryID'] = $galleryId;
		
		$data['image'] = $this->GalleryPictureComp->getPicture($this,$imageId);
		
		//if($next < sizeof($pictures))
		//	$data['next'] = $pictures[$next]['id'];
		
		//if($previous >= 0)
		//	$data['previous'] = $pictures[$previous]['id'];
		
		//debug(array($displayPosition,$previous,$next));
		
		$this->set('data',$data);
	}
	
}