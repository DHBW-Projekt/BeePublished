<?php
class GalleryOverviewComponent extends Component
{
	public $components = array('Gallery.Gallery','Gallery.DisplayGallery');
	
	public function getData($controller, $params, $url, $id)
	{
		if(is_array($url)){
			return $this->DisplayGallery->getData($controller,array('galleryID' => $url[1]),$url,$id);
		}
		return $this->Gallery->getAllGalleries($controller);
	}

}