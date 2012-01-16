<?php

class WebShopAppController extends AppController {
	
	function beforeFilter()	{
		$this->theme = $this->Config->getValue('active_template');
		$this->set('design',$this->Config->getValue('active_design'));
	}
}

