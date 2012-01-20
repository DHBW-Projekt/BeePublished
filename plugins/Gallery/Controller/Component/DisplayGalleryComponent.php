<?php
class DisplayGalleryComponent extends Component
{
	public $components = array('Gallery.Gallery');
	
	public function getData($controller, $params, $url, $id)
	{
		//debug($params);
		if(isset($params['galleryID']))
			return $this->Gallery->getGallery($controller,$params['galleryID']);
	}

}