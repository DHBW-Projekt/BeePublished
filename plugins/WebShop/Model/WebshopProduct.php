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
		        	'message' => '"Name" is mandatory.'
		        ),
		        
		        'description' => array(
		        	'rule' => 'notEmpty',
					'required' => true,
			        'message' => '"Description" is mandatory.'
		        ),
		        
				'price' => array(
					'rule' => 'numeric',
				    'required' => true,
					'allowEmpty' => false,
				    'message'  => '"Price" is mandatory.'
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
	
	/**
	 * Translation support
	 */
	public $actsAs = array(
		        'Translate' => array(
		            'name', 'description'
		)
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("web_shop", $value, true));
	}
}
