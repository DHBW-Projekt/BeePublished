<?php
App::uses('AppModel', 'Model');
/**
 * NewsEntry Model
 *
 */
class NewsEntry extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
	
	/**
	* belongsTo associations
	*
	* @var array
	*/
	public $belongsTo = array(
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter a title.'
			),
		),
		'text' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter the news entry\'s text.'
			),
		)
	);
}
