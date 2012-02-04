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
 * @description Model of categories table
 */
App::uses('AppModel', 'Model');
/**
 * FoodMenuCategory Model
 *
 * @property FoodMenuMenusFoodMenuCategory $FoodMenuMenusFoodMenuCategory
 * @property FoodMenuCategoriesFoodMenuEntry $FoodMenuCategoriesFoodMenuEntry
 */
class FoodMenuCategory extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $validate = array(
		'name' => array(
         		'name_notEmpty' => array(
         			'rule'    => 'notEmpty',
					'required' => true,
            		'message' => 'This field name has to be filled.'
         		),
         		'name_isalphanumeric' => array(
         			'rule' => array('custom', '/^[\\w\\s]+$/u'),
					'message' => 'You have to enter numbers or letters.'
         		)
         )
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'FoodMenuMenusFoodMenuCategory' => array(
			'className' => 'FoodMenuMenusFoodMenuCategory',
			'foreignKey' => 'food_menu_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'FoodMenuCategoriesFoodMenuEntry' => array(
			'className' => 'FoodMenuCategoriesFoodMenuEntry',
			'foreignKey' => 'food_menu_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d('food_menu', $value, true));
	} 

}
