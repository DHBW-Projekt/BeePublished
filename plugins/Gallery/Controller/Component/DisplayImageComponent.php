<?php
class DisplayImageComponent extends Component
{
	public $components = array('Gallery.GalleryPictureComp');
	
	public function getData($controller, $params, $url, $id)
	{
		if(isset($params['pictureID']))
			return $this->GalleryPictureComp->getPicture($controller,$params['pictureID']);
	}

}