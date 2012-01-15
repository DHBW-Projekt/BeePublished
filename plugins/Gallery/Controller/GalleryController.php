<?php
App::uses('GalleryAppController', 'Gallery.Controller');

class GalleryController extends GalleryAppController {
	
	public $components = array('ContentValueManager');

    public function admin($contentId)
    {
        $this->layout = 'overlay';
    }

}