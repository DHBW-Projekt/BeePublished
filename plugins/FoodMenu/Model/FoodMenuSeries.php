<?php
App::uses('AppModel', 'Model');
/**
 * FoodMenuSeries Model
 *
 * @property FoodMenuMenu $FoodMenuMenu
 */
class FoodMenuSeries extends AppModel {
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
	public $displayField = 'seriesValue';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'FoodMenuMenu' => array(
			'className' => 'FoodMenuMenu',
			'foreignKey' => 'food_menu_series_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
