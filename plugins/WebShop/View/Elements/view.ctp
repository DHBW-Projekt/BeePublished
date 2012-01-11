<!-- Web-Shop product detail view -->
<?php 	
	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//CREATE product details
	echo '<div id="webshop_detailview">';
	echo '<h2>'.$data['Product']['name'].'</h2>';
	echo '<p class="websop_price">'.$data['Product']['price'].' '.$data['Product']['currency'].'</p>';
	echo '<p>'.$this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => $url.'/webshop/add/'.$data['Product']['id'], 'class' => "webshop_cart_icon")).'</p>';
	echo $this->Html->image('/WebShop/img/products/'.$data['Product']['picture'], array('class' => "webshop_detailview_image", 'style' => "margin-right: 10px"));
	echo $data['Product']['description'];
	echo '<br style="clear:left">';

	echo '</div>';