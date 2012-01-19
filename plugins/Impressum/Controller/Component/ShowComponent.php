<?php

class ShowComponent extends Component {

	//I just copied this from guestbook
	public $name = 'ImpressumComponent';

	//here is the getData function as requested in the manual
	public function getData($controller, $params, $url) {
		//another copy from guestbook
		$controller->set('title_for_layout', __('Impressum'));
		//load the model which is called Impressum
		$controller->loadModel('Impressum.Impressum');
		//return the first entry
		//as the table only has one entry, this is will work fine
		return $controller->Impressum->find('first');
	}

	//authorization check
	public function beforeFilter() {
		parent::beforeFilter();

		//actions which don't require authorization
		$this->Auth->allow('show');
	}
}