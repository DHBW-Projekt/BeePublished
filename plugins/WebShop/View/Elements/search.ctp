<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Wuerttemberg Mannheim
 * @author Maximilian Stueber and Patrick Zamzow
 *
 * @description Web-Shop Search View.
 */

	//HELPER
	App::uses('Sanitize', 'Utility');
	$this->Helpers->load('BBCode');

	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//TITLE
	echo '<div id ="websop_productcatalog">';
	echo '<h2>'.__d("web_shop", 'Search results').'</h2>';
	
	//CREATE search results
	if(isset($this->Paginator))
		$result_count = $this->Paginator->counter('{:count}');
	else 
		$result_count = 0;
	
	if ($result_count > 1 || $result_count == 0) {
		$count_lbl = __d("web_shop", 'Search results');
	}else{
		$count_lbl = __d("web_shop", 'Search result');
	}

	echo '<p class="webshop_search_result">';	
		echo $result_count.' '.$count_lbl;
	echo '</p>';
	
	//CREATE serch catalog
	$last_element = (!isset($data['search'])) ? null : end($data['search']);
	
	if (isset($this->Paginator) && $this->Paginator->counter('{:pages}') > 1)
		$start_value = ($this->Paginator->counter('{:page}') - 1) * $data['limit'] + 1;
	else
		$start_value = 1;
	
	//PRINT products	
	echo '<div start="'.$start_value.'">';
	foreach ((!isset($data['search'])) ? array() : $data['search'] as $product){
		
		echo $this->Html->image($product['WebshopProduct']['picturePath'].$product['WebshopProduct']['picture'], array('url' => $url.'/webshop/view/'.$product['WebshopProduct']['id'], 'escape' => False));
	
		echo '<h3>';
		echo $this->Html->link($product['WebshopProduct']['name'], $url.'/webshop/view/'.$product['WebshopProduct']['id']);
		echo '</h3>';
	
		echo '<p class="websop_price">'.$product['WebshopProduct']['price'];
		echo ' '.$product['WebshopProduct']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $this->BBCode->removeBBCode(Sanitize::html($product['WebshopProduct']['description'])), 'productID' => $product['WebshopProduct']['id'], 'url' => $url));
		echo '<br style="clear:left">';
		
		//NO line for last element
		if($last_element != $product){
			echo '<hr class="websop_separator">';
		}
	}
	
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