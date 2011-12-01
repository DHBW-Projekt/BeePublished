<?php
App::uses('AppModel', 'Model');
/**
 * Layout Model
 *
 * @property Container $Container
 * @property LayoutType $LayoutType
 * @property Container $Container
 */
class Layout extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Container' => array(
			'className' => 'Container',
			'foreignKey' => 'container_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LayoutType' => array(
			'className' => 'LayoutType',
			'foreignKey' => 'layout_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Container' => array(
			'className' => 'Container',
			'foreignKey' => 'layout_id',
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
