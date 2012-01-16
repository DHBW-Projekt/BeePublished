<!-- Web-Shop Shopping Cart View -->
<?php
//INTEGRATE searchbar
echo $this->element('SearchBar', array('url' => $url));

//CREATE cart
echo '<div id ="webshop_cart">';
echo '<h2>Einkaufswagen</h2>';

//CHECK if cart has products
if(empty($data)){
	echo '<p>Keine Elemente in Ihrem Einkaufswagen.</p>';
} else {
	echo '<table>';
	echo '<tr>';
	echo '<th colspan="2">Artikel</th><th>Preis</th><th colspan="2">Menge</th>';
	echo '</tr>';

	//GET all products
	foreach ($data as $product){
		echo '<tr>';
		echo '<td>'.$this->Html->image('/WebShop/img/products/'.$product['Product']['picture'], array('class' => "webshop_cart_product_img")).'</td>';
		echo '<td>'.$this->Html->link($product['Product']['name'], $url.'/webshop/view/'.$product['Product']['id']).'</td>';
		echo '<td>'.$product['Product']['price'].'</td>';
		echo '<td>'.$product['count'].'</td>';
		echo '<td>'.$this->Html->image('add2.png', array('url' => $url.'/webshop/add/'.$product['Product']['id'], 'class' => "webshop_cart_icon")).$this->Html->image('remove.png',array('url' => $url.'/webshop/remove/'.$product['Product']['id'], 'class' => "webshop_cart_icon")).'</td>';
		echo '</tr>';
	}

	echo '</table>';
}

//ORDER button
if(!empty($data))
echo $this->Html->link('Bestellung abschicken', $url.'/webshop/submitOrder', array('style' => 'font-weight: bold'));

echo '</div>';