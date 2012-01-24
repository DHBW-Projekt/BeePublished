<?php

class ImpressumAppController extends AppController {

	public $name = 'Impressum';
	
	//authorization check
	function beforeFilter()	{
		//Actions which don't require authorization
		parent::beforeFilter();
		//TODO change to save
		$this->Auth->allow('*');
	}
}