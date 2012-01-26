<?php
App::uses('AppModel', 'Model');
/**
 * GalleryEntry Model
 *
 * @property GalleryPicture $GalleryPicture
 * @property GalleryPicture $GalleryPicture
 */
class GalleryEntry extends AppModel {
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
		'GalleryPicture' => array(
			'className' => 'GalleryPicture',
			'foreignKey' => 'gallery_picture_id',
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
		'GalleryPicture' => array(
			'className' => 'GalleryPicture',
			'foreignKey' => 'gallery_entry_id',
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
