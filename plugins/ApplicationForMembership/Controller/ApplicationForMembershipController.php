<?php
/**
 * ApplicationForMembership-Controller
 *
 * @author Yvonne Laier
 */
class ApplicationForMembershipController extends AppController {
	
	/**
	 * Admin-Views
	 */
	public function admin($contentId) {
		$this->layout = 'overlay';
	}
	
	/**
	 * Before-Filter
	 */
	public function beforeFilter(){
		//Permissions
		$this->Auth->allow('*');
	}
}

