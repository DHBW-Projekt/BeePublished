<?php
	echo $this->element('SearchBar');
	
	if (isset($data)) {
		foreach ($data as $product){
			echo '<div>';
			echo $this->Html->link(
				$this->Html->image('/WebShop/img/'.$product['Products']['picture'], array('style' => "float: left", "width" => "200px")),
				array('plugin' => 'webshop', 'controller' => '', 'action' => 'view', $product['Products']['id']), array('escape' => False)
			);
			
			echo $this->Html->link($product['Products']['name'], array('plugin' => 'webshop', 'controller' => '', 'action' => 'view', $product['Products']['id']));
			
			echo '<p>'.$product['Products']['price'];
			echo ' '.$product['Products']['currency'].'</p>';
			echo $this->element('ShortText', array( 'text' => $product['Products']['description'], 'productID' => $product['Products']['id']));
			echo '</div>';
			echo '<br style="clear:left">';
		}
	}
?>