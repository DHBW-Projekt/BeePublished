<?php
App::uses('AppModel', 'Model');
/**
 * Product Model.
 */
class Product extends AppModel {
	
   /**
	* Model name
	*/
	public $name = 'Product';
	
	
	/**
	 *  Display field
	 */
	public $displayField = 'name';
	
	
	/**
	 * 
	 * Pagination
	 */
	public $paginate = array(
	        'limit' => 10,
	        'order' => array(
	            'Product.id' => 'asc'
	)
	);
	
	
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
					'rule' => array('decimal', 2),
				    'required' => true,
					'allowEmpty' => false,
				    'message'  => 'Preis ist eine Zahl.'
				)
	);
}
