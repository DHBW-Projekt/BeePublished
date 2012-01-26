<?php

class YoutubeComponent extends Component {

	public $name = 'YoutubeComponent';

	public function getData($controller, $params, $url_exts, $contentId){
		
		// load the used model in order to receive data
		$controller->loadModel('Youtube.YoutubeLink');
		// there is only one video for each contentId
		return $controller->YoutubeLink->find('first', array('conditions' => array('contentId' => $contentId)));
	}
}