<?php

class DisplayComponent extends Component {
	
	public $components = array('Guestbook.Guestbook');
	
	public function getData($controller, $params)
	{
		return $this->Guestbook->display($controller, $params);	
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}