<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuMenu Model
 *
 * @property FoodMenuSerie $FoodMenuSerie
 * @property FoodMenuCategory $FoodMenuCategory
 */
class FoodMenuMenu extends AppModel {
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FoodMenuSeries' => array(
			'className' => 'FoodMenuSeries',
			'foreignKey' => 'food_menu_series_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'FoodMenuCategory' => array(
			'className' => 'FoodMenuCategory',
			'joinTable' => 'food_menu_menus_food_menu_categories',
			'foreignKey' => 'food_menu_menu_id',
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
