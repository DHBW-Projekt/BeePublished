<?php
App::uses('AppModel', 'Model');

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
 * @description Model ApplicationMembership
 */
class ApplicationMembership extends AppModel{
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("ApplicationMembership", $value, true));
	}
	
	
	/**
	 * Validation
	 */
	public $validate = array(
			'type' => array(
					'rule' => 'notEmpty',
					 'message' => 'Please enter the application type.'
			),
			'title' => array(
					'rule' => 'notEmpty',
					 'message' => 'Please enter your title.'
			),
			'last_name' => array(
			        'rule' => 'notEmpty',
			        'message' => 'Please enter your lastname.'
			),
			'first_name' => array(
			        'rule' => 'notEmpty',
			        'message' => 'Please enter your firstname.'
			),
			'date_of_birth' => array(
						'rule' => 'date',
						'allowEmpty'=> false,
						'message' => 'Please enter your day of birth.'
			),
		    'email' => array(
		     	   'rule' => 'email',
		           'message' => 'Please enter your email.'
			),
			'street' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your street and street number.'
			),
			'zip' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your zip.'
			),
			'city' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter your city.'
			)
	);
}