<?php

/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Yvonne Laier and Maximilian Stueber
 *
 * @description ApplicationMembership-Controller
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

