<?php
App::uses('AppModel', 'Model');
/**
 * Content Model
 *
 * @property Container $Container
 * @property PluginView $PluginView
 * @property ContentValue $ContentValue
 */
class Content extends AppModel {

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
		'PluginView' => array(
			'className' => 'PluginView',
			'foreignKey' => 'plugin_view_id',
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
		'ContentValue' => array(
			'className' => 'ContentValue',
			'foreignKey' => 'content_id',
			'dependent' => true,
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
