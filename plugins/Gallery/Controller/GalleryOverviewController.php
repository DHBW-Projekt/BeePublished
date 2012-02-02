<?php
class GalleryOverviewController extends AppController {
	var $layout = 'overlay';
	public function admin($contentId){
		$this->set("ContentId",$contentId);
		$this->set("mContext",'overview');		
	}
	
}