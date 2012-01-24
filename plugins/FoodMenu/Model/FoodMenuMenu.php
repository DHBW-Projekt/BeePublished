<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuMenu Model
 *
 * @property FoodMenuMenusFoodMenuCategory $FoodMenuMenusFoodMenuCategory
 */
class FoodMenuMenu extends AppModel {
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
	public $validate = array(
		'name' => array(
	        	'name_isUnique' => array(
            		'rule'    => 'isUnique',
            		'message' => 'This entry already exists.',
         		),
         		'name_notEmpty' => array(
         			'rule'    => 'notEmpty',
					'required' => true,
            		'message' => 'This field has to be filled.'
         		),
         		'name_isalphanumeric' => array(
         			'rule' => array('custom', '/^[\\w\\s]+$/u'),
					'message' => 'You have to enter numbers or letters.'
         		)
		),
		'valid_from' => array(
				'rule' => 'date',
				'message' => 'Please enter a date.'
		),
		'valid_until' => array(
				'rule' => 'date',
				'message' => 'Please enter a date.'
		)
	);
	
	public $hasMany = array(
		'FoodMenuMenusFoodMenuCategory' => array(
			'className' => 'FoodMenuMenusFoodMenuCategory',
			'foreignKey' => 'food_menu_menu_id',
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
