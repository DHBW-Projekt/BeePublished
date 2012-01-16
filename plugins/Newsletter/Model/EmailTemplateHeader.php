<?php
App::uses('AppModel', 'Model');
/**
 * EmailTemplateHeader Model
 *
 * @property EmailTemplate $EmailTemplate
 */
class EmailTemplateHeader extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'EmailTemplate' => array(
			'className' => 'EmailTemplate',
			'foreignKey' => 'email_template_header_id',
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
