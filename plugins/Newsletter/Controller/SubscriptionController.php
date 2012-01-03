<?php

class SubscriptionController extends AppController {
		
	var $autoLayout = false;
	
	public function admin($contentID){
// 		$this->loadModel("ContentValues");
		
	}
	
// 	function _getContentValue($contentID) {
// 		return $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
// 	}
		
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}