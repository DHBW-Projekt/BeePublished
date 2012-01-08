<?php

class EditorComponent extends Component {
	
	public $components = array('StaticText.DisplayText');
	
	public function getData($controller, $params)
	{
		return $this->DisplayText->getData($controller, $params);
	}	
}