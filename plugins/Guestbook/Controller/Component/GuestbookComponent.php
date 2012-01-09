<?php

class GuestbookComponent extends Component {

	public $name = 'GuestbookComponent';
	public $components = array('Paginator','PermissionValidation');

	public function getData($controller, $params){
		
		//set page title
		$controller->set('title_for_layout', __('Guestbook'));
		
		//load the used model in order to receive data
		$controller->loadModel('Guestbook.GuestbookPost');
		
		//change default limit of items per page for paginator to 10
		$this->Paginator->settings = array(
		 			'limit' => 10,
		);
		
		//check user authorisation and get data
		//unfortunately query for NOT seems to be not working if NULL is used...
		if ($this->PermissionValidation->actionAllowed($this->_getPluginId($controller), 'release')){ 
			//show all posts which are not already deleted
			$allGuestbookPosts = $controller->paginate('GuestbookPost', array('deleted' => '0000-00-00 00:00:00'));
		} else {
			//normal user / guest is only allowed to see released and not deleted posts
			$allGuestbookPosts = $controller->paginate('GuestbookPost', array('released NOT' => '0000-00-00 00:00:00','deleted' => '0000-00-00 00:00:00'));
		}
		
		return $allGuestbookPosts;
	}
	
	function _getPluginId($controller){
		$controller->loadModel('Plugin');
		$plugin = $controller->Plugin->findByName('Guestbook');
		return $plugin['Plugin']['id'];
	}
}