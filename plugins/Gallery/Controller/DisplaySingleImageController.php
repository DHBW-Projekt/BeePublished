<?php
class DisplaySingleImageController extends GalleryAppController 
{
	public $components = array('Gallery.Gallery','Gallery.GalleryPictureComp');
		var $layout = 'overlay';
		
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('display');
	}
	
	public function display($galleryid, $pictureid){
	
		$image = $this->GalleryPictureComp->getPicture($this, $pictureid);
		
		$data = array(	'image' => $image,
		);
		$this->set('data',$data);
	}
}