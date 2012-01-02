<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuCategory Model
 *
 * @property FoodMenuEntry $FoodMenuEntry
 * @property FoodMenuMenu $FoodMenuMenu
 */
class FoodMenuCategory extends AppModel {
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'ID';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'FoodMenuEntry' => array(
			'className' => 'FoodMenuEntry',
			'joinTable' => 'food_menu_categories_food_menu_entries',
			'foreignKey' => 'food_menu_category_id',
			'associationForeignKey' => 'food_menu_entry_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'FoodMenuMenu' => array(
			'className' => 'FoodMenuMenu',
			'joinTable' => 'food_menu_menus_food_menu_categories',
			'foreignKey' => 'food_menu_category_id',
			'associationForeignKey' => 'food_menu_menu_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
