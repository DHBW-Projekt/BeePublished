<?php
App::uses('AppModel', 'Model');
/**
 * GoogleMapsLocation Model
 *
 */
class GoogleMapsLocation extends AppModel {
	
	/**
	*  Validation
	*/
	public $validate = array(
			        'street' => array(
			        	'rule' => 'notEmpty',
						'required' => true,
			        	'message' => '"Street" is mandatory.'
					),
	
			        'street_number' => array(
			        	'rule' => 'notEmpty',
						'required' => true,
				        'message' => '"Street number" is mandatory.'
					),
	
					'city' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"City" is mandatory.'
					),
	
					'zip_code' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"Zip code" is mandatory.'
					),
	
					'country' => array(
						'rule' => 'notEmpty',
						'required' => true,
					    'message' => '"Country" is mandatory.'
					),
	);
	
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __d("google_maps", $value, true));
	}
}
