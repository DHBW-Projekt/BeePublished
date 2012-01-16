<?php
/**
 * ApplicationForMembership-Controller
 *
 * @author Yvonne Laier
 */
class ApplicationForMembershipController extends AppController {
	
	//Attributs
	var $uses = array('ApplcationForMembership.ApplicationMembership');
	var $layout = 'overlay';
	
	/**
	 * Admin-Views
	 */
	public function admin($contentId) {
		$this->set('applications', $this->ApplicationMembership->findAllByStatus('0'));
		$this->set('contentID', $contentID);
	}
	
	/**
	 * Before-Filter
	 */
	public function beforeFilter(){
		//Permissions
		$this->Auth->allow('*');
	}
}

