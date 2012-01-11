<!-- Web-Shop Search View -->
<?php

	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//TITLE
	echo '<div id ="websop_productcatalog">';
	echo '<h2>Suchergebnisse</h2>';
	
	//CREATE search results
	if(isset($this->Paginator))
		$result_count = $this->Paginator->counter('{:count}');
	else 
		$result_count = 0;
	
	if ($result_count > 1 || $result_count == 0) {
		$count_lbl = 'Suchergebnisse';
	}else{
		$count_lbl = 'Suchergebnis';
	}

	echo '<p class="webshop_search_result">';	
		echo $result_count.' '.$count_lbl;
	echo '</p>';
	
	//CREATE serch catalog
	$last_element = (!isset($data)) ? null : end($data);
	
	if (isset($this->Paginator) && $this->Paginator->counter('{:pages}') > 1)
		$start_value = ($this->Paginator->counter('{:page}') - 1) * 10 + 1;
	else
		$start_value = 1;
	
	//PRINT products
	echo '<ol start="'.$start_value.'">';
	foreach ((!isset($data)) ? array() : $data as $product){
		echo '<li>';
		
		echo $this->Html->image('/WebShop/img/products/'.$product['Product']['picture'], array('url' => $url.'/webshop/view/'.$product['Product']['id'], 'escape' => False));
	
		echo '<h3>';
		echo $this->Html->link($product['Product']['name'], $url.'/webshop/view/'.$product['Product']['id']);
		echo '</h3>';
	
		echo '<p class="websop_price">'.$product['Product']['price'];
		echo ' '.$product['Product']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['Product']['description'], 'productID' => $product['Product']['id'], 'url' => $url));
		echo '<br style="clear:left">';
		echo '</li>';
		
		//NO line for last element
		if($last_element != $product){
			echo '<hr class="websop_separator">';
		}
	}
	echo '</ol>';
	
	//PAGINATION numbers
	if (isset($this->Paginator) && $this->Paginator->counter('{:pages}') > 1) {
		
		//Attribute
		$link_pattern = 'pages/display/';
		
		//PREV
		if($this->Paginator->counter('{:page}') != 1){
			$prev = $this->Paginator->prev('<<');
			echo str_replace($link_pattern, '', $prev).' ';
		}
	
		//NUMBERS
		$numbers = $this->Paginator->numbers();
		echo str_replace($link_pattern, '', $numbers);
		
		//NEXT
		if($this->Paginator->counter('{:page}') != $this->Paginator->counter('{:pages}')){
			$next = $this->Paginator->next('>>');
			echo ' '.str_replace($link_pattern, '', $next);
		}
	}
	
	echo '</div>';
?>