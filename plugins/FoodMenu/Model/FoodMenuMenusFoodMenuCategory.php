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
 * @author Benedikt Steffan
 * 
 * @description Model of n:m association table between menus and categories
 */
App::uses('AppModel', 'Model');
/**
 * FoodMenuMenusFoodMenuCategory Model
 *
 * @property FoodMenuMenu $FoodMenuMenu
 * @property FoodMenuCategory $FoodMenuCategory
 */
class FoodMenuMenusFoodMenuCategory extends AppModel {
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'ID';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ID' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'food_menu_menu_id' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'food_menu_category_id' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FoodMenuMenu' => array(
			'className' => 'FoodMenuMenu',
			'foreignKey' => 'food_menu_menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FoodMenuCategory' => array(
			'className' => 'FoodMenuCategory',
			'foreignKey' => 'food_menu_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
