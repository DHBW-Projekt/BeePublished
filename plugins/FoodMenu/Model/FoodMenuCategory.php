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

}
