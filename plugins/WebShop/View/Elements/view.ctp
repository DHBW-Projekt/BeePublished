<!-- Web-Shop product detail view -->
<?php 
	//CALL stylesheet
	echo $this->Html->css('webshop');
	
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//CREATE product details
	echo '<div id="webshop_detailview">';
	echo '<h2>'.$data['Product']['name'].'</h2>';
	echo '<p class="websop_price">'.$data['Product']['price'].' '.$data['Product']['currency'].'</p>';
	echo $this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'add', $data['Product']['id']), 'class' => "webshop_cart_icon"));
	
	echo $this->Html->image('/WebShop/img/'.$data['Product']['picture'], array('class' => "webshop_detailview_image"));
	echo $data['Product']['description'];

	echo '</div>';