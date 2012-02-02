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
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("web_shop", $value, true));
	}
	
	function afterFind($results, $primary) {
		if ($primary) {
			foreach ($results as $key => $val) {
				if (isset($val['WebshopProduct']['picture']))
					$results[$key]['WebshopProduct']['picturePath'] = $this->getPicturePath($val['WebshopProduct']['picture']);
			}	
		} else {
			$results['picturePath'] = $this->getPicturePath($results['picture']);
		}
		
		return $results;
	}
	
	function getPicturePath($picture) {
		if ($picture == 'no_image.png') {
			return '/WebShop/img/products/';
		} else {
			return '/uploads/products/';
		}
		
	}
}
