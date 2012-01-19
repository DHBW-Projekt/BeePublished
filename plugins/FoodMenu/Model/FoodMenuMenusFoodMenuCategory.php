<?php
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
