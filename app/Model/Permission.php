<?php
App::uses('AppModel', 'Model');
/**
 * Permission Model
 *
 * @property Plugin $Plugin
 * @property Role $Role
 */
class Permission extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Plugin' => array(
			'className' => 'Plugin',
			'foreignKey' => 'plugin_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
