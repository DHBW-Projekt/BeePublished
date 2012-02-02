<!-- Web-Shop Product Overview -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//CREATE catalog
	$last_element = (!isset($data['Product'])) ? null : end($data['Product']);
	
	if (isset($this->Paginator) && $this->Paginator->counter('{:pages}') > 1)
		$start_value = ($this->Paginator->counter('{:page}') - 1) * $data['Limit'] + 1;
	else
		$start_value = 1;
	
	echo '<ol start="'.$start_value.'" id="websop_productcatalog">';
	
	foreach ((!isset($data['Product'])) ? array() : $data['Product'] as $product){
		echo '<li>';
		
		echo $this->Html->image($product['WebshopProduct']['picturePath'].$product['WebshopProduct']['picture'], array('url' => $url.'/webshop/view/'.$product['WebshopProduct']['id'], 'escape' => False));
		
		echo '<h3>';
		echo $this->Html->link($product['WebshopProduct']['name'], $url.'/webshop/view/'.$product['WebshopProduct']['id']);
		echo '</h3>';
		
		echo '<p class="websop_price">'.$product['WebshopProduct']['price'].' '.$product['WebshopProduct']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['WebshopProduct']['description'], 'productID' => $product['WebshopProduct']['id'], 'url' => $url));
		
		echo '</li>';
		
		//CLEAR floating
		echo '<br style="clear:left">';
		
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
?>