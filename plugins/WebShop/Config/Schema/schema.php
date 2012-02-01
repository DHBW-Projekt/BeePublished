<?php 
/* WebShop schema generated on: 2012-01-15 11:35:43 : 1326623743*/
class WebShopSchema extends CakeSchema {
	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $webshop_orders = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
			'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
			'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => NULL, 'comment' => ''),
			'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'collate' => NULL, 'comment' => ''),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_customer' => array('column' => 'customer_id', 'unique' => 0)),
			'tableParameters' => array('charset' => 'latin1', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	var $webshop_positions = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
			'order_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
			'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
			'count' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_order' => array('column' => 'order_id', 'unique' => 0), 'fk_product' => array('column' => 'product_id', 'unique' => 0)),
			'tableParameters' => array('charset' => 'latin1', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	var $webshop_products = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
			'price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '11,2', 'collate' => NULL, 'comment' => ''),
			'currency' => array('type' => 'string', 'null' => false, 'default' => 'EUR', 'length' => 3, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
			'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
			'picture' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
			'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'collate' => NULL, 'comment' => ''),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
			'tableParameters' => array('charset' => 'latin1', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
}
?>