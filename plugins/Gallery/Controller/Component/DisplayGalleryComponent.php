<?php
class DisplayGalleryComponent extends Component
{
	public $components = array('Gallery.Gallery');
	
	public function getData($controller, $params, $url, $id)
	{		
		if(isset($params['galleryID'])){
			$data = $this->Gallery->getGallery($controller,$params['galleryID']);
			$data['view'] = 'Single';
			return $data;
		}else {
			return null;
		}
	}

}