<!-- Web-Shop Shopping Cart View -->
<?php
	//CALL stylesheet
	echo $this->Html->css('webshop');
	
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//CREATE cart
	echo '<div id ="webshop_cart">';
	echo '<h2>Einkaufswagen</h2>';
	
	//CHECK if cart has products
	if(isset($data)){
		echo '<p>Keine Elemente in Ihrem Einkaufswagen.</p>';
	} else {
		echo '<table>';
		echo '<tr>';
		echo '<th colspan="2">Artikel</th><th>Preis</th><th colspan="2">Menge</th>';
		echo '</tr>';
	
		//GET all products
		foreach ($data as $product){
			echo '<tr>';
			echo '<td>'.$this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('class' => "webshop_cart_product_img")).'</td>';
			echo '<td>'.$this->Html->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id'])).'</td>';
			echo '<td>'.$product['Product']['price'].'</td>';
			echo '<td>'.$product['count'].'</td>';
			echo '<td>'.$this->Html->image('/WebShop/img/Add.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'add', $product['Product']['id']), 'class' => "webshop_cart_icon")).$this->Html->image('/WebShop/img/Minus.png',array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'remove', $product['Product']['id']), 'class' => "webshop_cart_icon")).'</td>';
			echo '</tr>';
		}
	
		echo '</table>';
	}
	
	echo '</div>';