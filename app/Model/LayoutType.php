<?php
App::uses('AppModel', 'Model');
/**
 * LayoutType Model
 *
 * @property Container $Container
 */
class LayoutType extends AppModel
{
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
        'Container' => array(
            'className' => 'Container',
            'foreignKey' => 'layout_type_id',
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
