<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuCategoriesFoodMenuEntry Model
 *
 * @property FoodMenuCategory $FoodMenuCategory
 * @property FoodMenuEntry $FoodMenuEntry
 */
class FoodMenuCategoriesFoodMenuEntry extends AppModel {
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
		'food_menu_entry_id' => array(
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
		'FoodMenuCategory' => array(
			'className' => 'FoodMenuCategory',
			'foreignKey' => 'food_menu_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FoodMenuEntry' => array(
			'className' => 'FoodMenuEntry',
			'foreignKey' => 'food_menu_entry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
