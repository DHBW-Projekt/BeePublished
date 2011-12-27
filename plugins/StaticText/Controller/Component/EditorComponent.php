<?php

class EditorComponent extends Component {
	
	public $components = array('StaticText.DisplayText');
	
	public function getData($controller, $params)
	{
		return $this->DisplayText->getData($controller, $params);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}