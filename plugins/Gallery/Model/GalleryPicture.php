<?php
App::uses('AppModel', 'Model');
/**
 * GalleryPicture Model
 *
 * @property GalleryEntry $GalleryEntry
 */
class GalleryPicture extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'GalleryEntry' => array(
			'className' => 'GalleryEntry',
			'foreignKey' => 'gallery_entry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
