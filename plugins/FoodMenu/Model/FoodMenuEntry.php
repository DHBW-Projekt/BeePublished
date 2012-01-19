<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuEntry Model
 *
 * @property FoodMenuCategoriesFoodMenuEntry $FoodMenuCategoriesFoodMenuEntry
 */
class FoodMenuEntry extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
		'name' => array(
	        	'name_isUnique' => array(
            		'rule'    => 'isUnique',
            		'message' => 'This entry already exists.',
         		),
         		'name_notEmpty' => array(
         			'rule'    => 'notEmpty',
					'required' => true,
            		'message' => 'This field name has to be filled.'
         		),
         		'name_isalphanumeric' => array(
         			'rule' => array('custom', '/^[\\w\\s]+$/u'),
					'message' => 'You have to enter numbers or letters.'
         		)
		),
		'currency' => array(
				'rule' => array('inList', array('EUR', 'USD', 'CAD', 'GBP')),
				'message' => 'Please enter a valid currency.'
		),
		'price' => array(
				'rule' => array('decimal', 2),
				'message' => 'Please enter a decimal value with two digits.'
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'FoodMenuCategoriesFoodMenuEntry' => array(
			'className' => 'FoodMenuCategoriesFoodMenuEntry',
			'foreignKey' => 'food_menu_entry_id',
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
