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
	public function admin() {	
		$this->set('applications', $this->ApplicationMembership->findAllByStatus(0));
	}
	
	/**
	 * Before-Filter
	 */
	public function beforeFilter(){
		//Permissions
		$this->Auth->allow('*');
	}
}

