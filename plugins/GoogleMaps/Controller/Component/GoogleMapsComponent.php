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
* @author Patrick Zamzow
*
* @description Get location from database
*/
class GoogleMapsComponent extends Component {

	/**
	 * Get location for location id
	 * @param $controller
	 * @param $params
	 * @return location
	 */
	public function getLocation($controller, $params){
		//check input
		if (!array_key_exists('LocationID',$params)) {
			return __('no location');
		} else {	
			//load model				
			$controller->loadModel("GoogleMapsLocation");
			
			//get location
			$location = $controller->GoogleMapsLocation->find('first', array('conditions' => array('GoogleMapsLocation.id' => $params['LocationID'])));
			
			//return result
			if ($location != null) {
				return $location;
			} else {
				return __('no location');
			}
		}
	}	
}