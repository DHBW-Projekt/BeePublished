<?php

class DisplayComponent extends Component {

	public $name = 'GuestbookComponent';
	public $components = array('Paginator');

	function beforeFilter()
	{
		//Actions which don't require authorization
		parent::beforeFilter();
		$this->Auth->allow('display');
	}

	public function getData($controller, $params){
		
		//set page title
		$controller->set('title_for_layout', __('Gästebuch'));
		
		//load the used model in order to receive data
		$controller->loadModel('Guestbook.GuestbookPost');
		
		//change default limit of items per page for paginator to 10
		$this->Paginator->settings = array(
		 			'limit' => 10,
		);

		//check user authorisation and get data
		// TODO implement check
		//normal user / guest is only allowed to see released and not deleted posts
		// 		$allGuestbookPosts = $controller->paginate('GuestbookPost', array('released NOT' => NULL,'deleted' => NULL));
		//admin user has to have unreleaased posts in order to release them
		$allGuestbookPosts = $controller->paginate('GuestbookPost',array('deleted' => NULL));
		return $allGuestbookPosts;
	}

}