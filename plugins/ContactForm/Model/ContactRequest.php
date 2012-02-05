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
* @author Maximilian Stüber, Corinna Knick
*
* @description activate multilingualism and set validation rules for input fields
*/

App::uses('AppModel', 'Model');

/**
 * ContactRequest Model.
 */
class ContactRequest extends AppModel {
	
	/*No DB*/
	public $useTable = false;
	
	/*Activate multilingualism*/
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("contact_form", $value, true));
	}
		
	/*Validation rules*/
	public $validate = array(
				'email' => array(
		            'rule' => 'email',
		            'required' => true,
					'message' => 'Please enter a valid e-mail address.'
		),
				'subject' => array(
		            'rule' => 'notEmpty',
					'message' => 'Please enter a subject.'
		),
		        'body' => array(
		            'rule' => 'notEmpty',
					'message' => 'Please enter your message.'
		)
	);

}