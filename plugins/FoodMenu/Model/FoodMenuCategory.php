<?php
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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

}
