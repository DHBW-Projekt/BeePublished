<?php
/**
 * ApplicationMembership-Controller
 *
 * @author Yvonne Laier
 */
class ApplicationMembershipController extends AppController {
	
	//Attributs
	var $uses = array('ApplicationMembership.ApplicationMembership');
	var $layout = 'overlay';
	
	/**
	 * Admin-Views
	 */
	public function admin($contentID) {	
		$this->set('contentID', $contentID);
		
		$this->set('applications', $this->ApplicationMembership->findAllByStatus(0));
	}
	
	/**
	 * Done-Selection Function.
	 */
	public function doneSelection($contentID){
		
		//GET all open applications
		$applications = $this->ApplicationMembership->findAllByStatus(0);
		
		//PROCESS selected elements
		foreach ((!isset($applications)) ? array() : $applications as $application) { 
			if ($this->data['SelectApplications'][$application['ApplicationMembership']['id']] == 1){
				$this->done($contentID, $application['ApplicationMembership']['id'], true);
			}
		}
		
		//REDIRECT
		$this->redirect(array('action' => 'admin', $contentID));
	}
	
	/**
	* Done-Selection Function.
	*/
	public function done($contentID, $id=null, $multiCall=null){
		
		$this->ApplicationMembership->id = $id;
		$data = $this->ApplicationMembership->read();
		
		$this->ApplicationMembership->set(array(
			'status' => '1'
		));

		$this->ApplicationMembership->save();
		
		//REDIRECT
		if(!$multiCall)
			$this->redirect(array('action' => 'admin', $contentID));	
	}
	
}

