<!-- Web-Shop product detail view -->
<?php 	
	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//CREATE product details
	echo '<div id="webshop_detailview">';
	echo $this->Html->image('/WebShop/img/products/'.$data['Product']['picture'], array('class' => "webshop_detailview_image", 'style' => "margin-right: 10px"));
	echo '<h2>'.$data['Product']['name'].'</h2>';
	
	echo '<table class="webshop_infobox">';
	echo '<tr>';
		echo '<td class="websop_price" style="float: left">Preis: '.$data['Product']['price'].' '.$data['Product']['currency'].'</td>';
		echo '<td style="padding-left:20px">'.$this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => $url.'/webshop/add/'.$data['Product']['id'], 'class' => "webshop_cart_icon")).'</td>';
	echo '</tr>';
	echo '</table>';
	
	echo '<br style="clear:left">';
	
	echo $data['Product']['description'];
	echo '</div>';