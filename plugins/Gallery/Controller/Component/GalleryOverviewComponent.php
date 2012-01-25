<?php
class GalleryOverviewComponent extends Component
{
	public $components = array('Gallery.Gallery');
	
	public function getData($controller, $params, $url, $id)
	{
		return $this->Gallery->getAllGalleries($controller);
	}
	
	public function displaySingleGallery($controller,$galleryId){
		debug($controller);
		debug($galleryId);
		return array();
	}

}