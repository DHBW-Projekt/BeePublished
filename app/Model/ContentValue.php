<?php
App::uses('AppModel', 'Model');
/**
 * ContentValue Model
 *
 * @property Content $Content
 * @property PluginViewValue $PluginViewValue
 */
class ContentValue extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Content' => array(
			'className' => 'Content',
			'foreignKey' => 'content_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
