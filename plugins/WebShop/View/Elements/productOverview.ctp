<!-- Web-Shop Product Overview -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//CREATE catalog
	$last_element = (!isset($data)) ? null : end($data);
	
	echo '<ol id="websop_productcatalog">';
	
	foreach ((!isset($data)) ? array() : $data as $product){
		echo '<li>';
		
		echo $this->Html->image('/WebShop/img/products/'.$product['Products']['picture'], array('url' => $url.'/webshop/view/'.$product['Products']['id'], 'escape' => False));
		
		echo '<h3>';
		echo $this->Html->link($product['Products']['name'], $url.'/webshop/view/'.$product['Products']['id']);
		echo '</h3>';
		
		echo '<p class="websop_price">'.$product['Products']['price'].' '.$product['Products']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['Products']['description'], 'productID' => $product['Products']['id']));
		
		echo '</li>';
		
		//CLEAR floating
		echo '<br style="clear:left">';
		
		//NO line for last element
		if($last_element != $product){
			echo '<hr class="websop_separator">';
		}
	}
	
	echo '</ol>';
?>