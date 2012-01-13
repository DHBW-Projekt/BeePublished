<?php
App::uses('AppModel', 'Model');
/**
 * NewsletterLetter Model
 *
 * @property EmailTemplate $EmailTemplate
 */
class NewsletterLetter extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'EmailTemplate' => array(
			'className' => 'EmailTemplate',
			'foreignKey' => 'email_template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
