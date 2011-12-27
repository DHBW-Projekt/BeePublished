<?php

class EditorController extends AppController {
var $autoLayout = false;
	
	public function admin($contentID){
		$this->loadModel("ContentValues");
		if (empty($this->data)) {
			$contentValue = $this->_getContentValue($contentID);
			if ($contentValue['ContentValues']['key'] == 'Text') {
				//Get Data from table content_values
				$this->data =  $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
				//$this->data =  $contentValue['ContentValues']['value'];
			}
		} else {
			
			
			$textID = $this->_checkIfTextExists($contentID);
				
			if (!$textID) {
			 	$cv = $this->data['ContentValues'];
			 	$cv['content_id'] = $contentID;
				$textID = $this->ContentValues->create($cv);
			}
			$contentValue = $this->_getContentValue($contentID);
			$this->ContentValues->set($contentValue);
			$this->ContentValues->set('key', 'Text');
			$this->ContentValues->set('value', $this->data['ContentValues']['value']);
			$this->ContentValues->save();
		}
	}
	
	
	function _checkIfTextExists($contentID) {
		$this->loadModel("ContentValues");
		$text = $this->_getContentValue($contentID); 
		if (isset($text)) {
			return $text;
		} else {
			return false;
		}
	}
	
	//muss noch geändert werden
	function _getContentValue($contentID) {
		//'ContentValues.content_id' =>
		return $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
	}
	
	public function beforeFilter(){
		$this->Auth->allow('*');
	}
}