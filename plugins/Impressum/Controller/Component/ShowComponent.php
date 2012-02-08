<?php

class ShowComponent extends Component {

	public $name = 'ImpressumComponent';
	public $components = array('Config');

	//here is the getData function as requested in the manual
	public function getData($controller, $params, $url) {
		$socialNetworks['facebook'] = $this->Config->getValue('facebook');
		$socialNetworks['twitter'] = $this->Config->getValue('twitter');
		$socialNetworks['googleplus'] = $this->Config->getValue('googleplus');
		$socialNetworks['xing'] = $this->Config->getValue('xing');
		$socialNetworks['linkedin'] = $this->Config->getValue('linkedin');
		$data['socialNetworks'] = $socialNetworks;
		$controller->set('title_for_layout', __('Impressum'));
		//load the model which is called Impressum
		$controller->loadModel('Impressum.Impressum');
		$data['Impressum'] = $controller->Impressum->find('first');
		//return the first entry
		//as the table only has one entry, this will work fine
		return $data;
	}

	//authorization check
	public function beforeFilter() {
		parent::beforeFilter();

		//actions which don't require authorization
		$this->Auth->allow('show');
	}
}