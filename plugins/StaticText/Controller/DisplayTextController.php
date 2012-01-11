<?php
/*
 * Controller for editing text
 */
class DisplayTextController extends StaticTextAppController {
	//main-function
	public function admin($contentID){
		//Load datatables
		$this->loadModel("ContentValues");
		$this->loadModel('Plugin');
		//find plugin
		$textPlugin = $this->Plugin->findByName($this->plugin);
		//Get plugin-ID
		$pluginId = $textPlugin['Plugin']['id'];
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
		//If you are in the requiered role
		if ($editAllowed){	
			//Load and save data
			if (!(empty($this->data))) {
				//Checks if the text exists
				$textID = $this->_checkIfTextExists($contentID);
					//New ContentValue
				if (!$textID) {
				 	$cv = $this->data['ContentValues'];
				 	$cv['content_id'] = $contentID;
					$textID = $this->ContentValues->create($cv);
				}
				//Saves the ContentValue
				$contentValue = $this->_getContentValue($contentID);
				$this->ContentValues->set($contentValue);
				$this->ContentValues->set('key', 'Text');
				$this->ContentValues->set('value',$this->data['editTextEditor']); //$this->data['ContentValues']['value'] ); //$this->data['editTextEditor']) ;//['textarea']);
				$this->ContentValues->save();
				
			}
		} else    { //If you are not aloowed to
		   $this->Session->setFlash(__('You are not authenticated to enter these page!'));
		   //Go to mainpage
			$this->redirect($this->referer());
		}
		$contentValue = $this->_getContentValue($contentID);
		//shows the saved data
		if ($contentValue['ContentValues']['key'] == 'Text') {
			//Get Data from table content_values
			$tmpContent =  $this->ContentValues->find('first', array('conditions' => array('ContentValues.content_id' => $contentID)));
			//set the data for the view
			$this->set('contentValue', $tmpContent);
			$this->data =  $tmpContent;
		}
	}
	
	//checks if the text exists
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
		
}