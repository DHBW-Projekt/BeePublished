<?php
class DisplayImageComponent extends Component
{
	public $components = array('Gallery.GalleryPicture');
	
	public function getData($controller, $params, $url, $id)
	{
		if(isset($params['pictureID']))
			return $this->GalleryPicture->getPicture($controller,$params['pictureID']);
	}

}