<?php
App::uses('AppModel', 'Model');
/**
 * Order Model.
 */
class WebshopOrder extends AppModel {
	
   /**
	*  DB-Relationship
	*/
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'customer_id'
		)
	);
	
	public $hasMany = array(
	        'WebshopPosition' => array(
	            'className'     => 'WebshopPosition',
	            'foreignKey'    => 'order_id',
	            'dependent'     => true
	)
	);
}
