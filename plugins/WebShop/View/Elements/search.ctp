<!-- Web-Shop Search View -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//TITLE
	echo '<div id ="webshop_search">';
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
		echo $this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('style' => "float: left", "width" => "200px"));
	
		echo '<h2>';
		echo $this->Html->link($product['Product']['name'], '/webshop/view/'.$product['Product']['id']);
		echo '</h2>';
	
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
	
	//Paginator
	//echo $this->Paginator->prev('Ç Previous', null, null, array('class' => 'disabled'));
	//echo $this->Paginator->numbers(array('first' => 2, 'last' => 2));
	//echo $this->Paginator->next('Next È', null, null, array('class' => 'disabled'));
	//echo $this->Paginator->counter();
	
	echo '</div>';
?>