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
 * @author Alexander Müller & Fabian Kajzar
 * 
 * @description Model
 */

App::uses('AppModel', 'Model');
/**
 * GalleryPicture Model
 *
 * @property GalleryEntry $GalleryEntry
 */
class GalleryPicture extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'GalleryEntry' => array(
			'className' => 'GalleryEntry',
			'foreignKey' => 'gallery_entry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d('gallery', $value, true));
	}
}
