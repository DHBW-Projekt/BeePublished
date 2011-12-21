<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuEntry Model
 *
 * @property FoodMenuCategory $FoodMenuCategory
 */
class FoodMenuEntry extends AppModel {
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
		'FoodMenuCategory' => array(
			'className' => 'FoodMenuCategory',
			'joinTable' => 'food_menu_categories_food_menu_entries',
			'foreignKey' => 'food_menu_entry_id',
			'associationForeignKey' => 'food_menu_category_id',
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
