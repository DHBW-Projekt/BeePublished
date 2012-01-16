<?php
App::uses('AppModel', 'Model');
/**
 * Product Model.
 */
class WebshopProduct extends AppModel {
	
	/**
	 *  Validation
	 */
	public $validate = array(
		        'name' => array(
		        	'rule' => 'notEmpty',
					'required' => true,
		        	'message' => '"Name" ist ein Pflichtfeld.'
		        ),
		        
		        'description' => array(
		        	'rule' => 'notEmpty',
					'required' => true,
			        'message' => '"Beschreibung" ist ein Pflichtfeld.'
		        ),
		        
				'price' => array(
					'rule' => 'numeric',
				    'required' => true,
					'allowEmpty' => false,
				    'message'  => '"Preis" ist eine Zahl.'
				)
	);
	
   /**
	*  DB-Relationship
	*/
	public $hasMany = array(
		        'WebshopPosition' => array(
		            'className'     => 'WebshopPosition',
		            'foreignKey'    => 'product_id',
		            'dependent'     => true
	)
	);
}
