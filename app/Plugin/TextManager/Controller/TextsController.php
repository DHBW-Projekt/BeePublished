<?php
class TextsController extends AppController {
		
	function index($content_id) {
        $text = $this->Text->find('first', array('conditions' => array('Text.content_id' => $content_id)));
        if ($text != null) {
            return $text['Text']['text'];
        } else {
            return "";
        }
    }
	
	function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}