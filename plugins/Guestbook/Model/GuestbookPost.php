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
* @author Sebastian Haase
*
* @description Model for Guestbook Post
* 			   Basic Validation is that no field is allowed to be empty
*/
App::uses('AppModel', 'Model');
/**
 * GuestbookPost Model
 *
 */
class GuestbookPost extends AppModel {
	
	public $name = 'GuestbookPost';
	// show last post first
	public $order = array('created' => 'desc');
	// raise error if field is empty - Sanitize in GuestbookPostController is used to prevent harmful code injections etc.
	public $validate = array(
		'author' => array(
		        'rule' => 'notEmpty',
		        'message' => 'Please enter your name.',
		),
		'title' => array(
		        'rule' => 'notEmpty',
		        'message' => 'Please enter a title.',
		),
	    'text' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Please enter some text.',
		),
	);	
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("Guestbook", $value, true));
	}
	
}
