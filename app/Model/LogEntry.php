<?php
App::uses('AppModel', 'Model');
/**
 * LogEntry Model
 *
 * @property User $User
 * @property Object $Object
 */
class LogEntry extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Object' => array(
			'className' => 'Object',
			'foreignKey' => 'object_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
