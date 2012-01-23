<?php

class GuestbookComponent extends Component {

	public $name = 'GuestbookComponent';
	public $components = array('Paginator', 'Guestbook.GuestbookContentValues');

	public function getData($controller, $params, $url_exts, $contentId){
		
		$data = array();
		if ($url_exts != NULL)
		foreach($url_exts as $url_part){
			$url_part == 'writePost';
			$data['writePost'] = "true";
			return $data;
		}
		
		// set page title
		$controller->set('title_for_layout', __('Guestbook'));
		
		// load the used model in order to receive data
		$controller->loadModel('Guestbook.GuestbookPost');
		
		// get desired number of posts per page
		$posts_per_page = $this->GuestbookContentValues->getValue($contentId, 'posts_per_page');
		$this->Paginator->settings = array(
		 			'limit' => $posts_per_page,
		);
		
		//get released posts
		//unfortunately query for NOT seems to be not working if NULL is used...
		return $controller->paginate('GuestbookPost', array('contentId' => $contentId, 
															'released NOT' => '0000-00-00 00:00:00', 
															'deleted' => '0000-00-00 00:00:00'));		
	}
	
	function _getPluginId($controller){
		$controller->loadModel('Plugin');
		$plugin = $controller->Plugin->findByName('Guestbook');
		return $plugin['Plugin']['id'];
	}
}