<!-- Web-Shop Search View -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//TITLE
	echo '<div id ="websop_productcatalog">';
	echo '<h2>Suchergebnisse</h2>';
	
	//CREATE search results
	if (count($data) > 1 || count($data) == 0) {
		$count_lbl = 'Suchergebnisse';
	}else{
		$count_lbl = 'Suchergebniss';
	}
	
	echo '<p class="webshop_search_result">';	
		echo count($data).' '.$count_lbl;
	echo '</p>';
	
	//CREATE serch catalog
	$last_element = (!isset($data)) ? null : end($data);
	
	echo '<ol>';
	foreach ((!isset($data)) ? array() : $data as $product){
		echo '<li>';
		echo $this->Html->image('/WebShop/img/'.$product['Product']['picture']);
	
		echo '<h3>';
		echo $this->Html->link($product['Product']['name'], '/webshop/view/'.$product['Product']['id']);
		echo '</h3>';
	
		echo '<p class="websop_price">'.$product['Product']['price'];
		echo ' '.$product['Product']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['Product']['description'], 'productID' => $product['Product']['id']));
		echo '<br style="clear:left">';
		echo '</li>';
		
		//NO line for last element
		if($last_element != $product){
			echo '<hr class="websop_separator">';
		}
	}
	echo '</ol>';
	
	echo '</div>';
?>