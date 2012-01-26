<?php
App::uses('AppModel', 'Model');
/**
 * Position Model.
 */
class WebshopPosition extends AppModel {
	
   /**
	*  DB-Relationship
	*/
	public $belongsTo = array(
		'WebshopOrder' => array(
					'className' => 'WebshopOrder',
					'foreignKey' => 'order_id'
		),
		
		'WebshopProduct' => array(
				'className' => 'WebshopProduct',
				'foreignKey' => 'product_id'
		)
	);
}


