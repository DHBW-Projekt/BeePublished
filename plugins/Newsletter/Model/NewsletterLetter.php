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
	public $validate = array(
		'subject' => array(
			'subject_notEmpty' => array(
				'rule'    => 'notEmpty', 
				'required' => true,
				'message' => 'A subject is missing.'),
		)
	);
}
