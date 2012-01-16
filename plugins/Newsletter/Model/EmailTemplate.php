<?php
App::uses('AppModel', 'Model');
/**
 * EmailTemplate Model
 *
 * @property EmailTemplateHeader $EmailTemplateHeader
 * @property EmailTemplateFooter $EmailTemplateFooter
 * @property NewsletterLetter $NewsletterLetter
 */
class EmailTemplate extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'EmailTemplateHeader' => array(
			'className' => 'EmailTemplateHeader',
			'foreignKey' => 'email_template_header_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'EmailTemplateFooter' => array(
			'className' => 'EmailTemplateFooter',
			'foreignKey' => 'email_template_footer_id',
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
		'NewsletterLetter' => array(
			'className' => 'NewsletterLetter',
			'foreignKey' => 'email_template_id',
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
