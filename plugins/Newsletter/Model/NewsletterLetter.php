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
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

App::uses('AppModel', 'Model');
/**
 * NewsletterLetter Model
 *
 * @property EmailTemplate $EmailTemplate
 */
class NewsletterLetter extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	function __construct($id = false, $table = null, $ds = null){
		parent::__construct($id, $table, $ds);
		$this->validate = array(
			'subject' => array(
				'subject_notEmpty' => array(
					'rule'    => 'notEmpty', 
					'required' => true,
					'message' => __d('newsletter','A subject is missing.'),
				)
			)
		);
	}
}
