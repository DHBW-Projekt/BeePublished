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
* @description Google Maps Location
*/
App::uses('AppModel', 'Model');

class GoogleMapsLocation extends AppModel {
	
	/**
	*  Validation
	*/
	public $validate = array(
			        'street' => array(
			        	'rule' => 'notEmpty',
						'required' => true,
			        	'message' => '"Street" is mandatory.'
					),
	
			        'street_number' => array(
			        	'rule' => 'notEmpty',
						'required' => true,
				        'message' => '"Street number" is mandatory.'
					),
	
					'city' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"City" is mandatory.'
					),
	
					'zip_code' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"Zip code" is mandatory.'
					),
	
					'country' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"Country" is mandatory.'
					),
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("google_maps", $value, true));
	}
}
