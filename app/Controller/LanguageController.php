<?php
App::uses('AppController', 'Controller');
/**
 * Plugin Controller
 *
 */
class LanguageController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('setLanguage');
    }

	function setLanguage($language) {
		$this->Session->write('Config.language', $language);
		$this->redirect($this->referer());
	}
}
