<?php
App::uses('AppModel', 'Model');
/**
 * Plugin Model
 *
 * @property Permission $Permission
 * @property PluginView $PluginView
 */
class Plugin extends AppModel {
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
		'Permission' => array(
			'className' => 'Permission',
			'foreignKey' => 'plugin_id',
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
		'PluginView' => array(
			'className' => 'PluginView',
			'foreignKey' => 'plugin_id',
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
