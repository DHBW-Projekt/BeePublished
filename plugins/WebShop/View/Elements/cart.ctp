<!-- Web-Shop Shopping Cart View -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar', array('url' => $url));
	
	//CREATE cart
	echo '<div id ="webshop_cart">';
	echo '<h2>'.__d("web_shop", 'Cart').'</h2>';
	
	//CHECK if cart has products
	if(empty($data)){
		echo '<p>'.__d("web_shop", 'No element in your cart.').'</p>';
	} else {
		echo '<table>';
		echo '<tr>';
		echo '<th colspan="2">'.__d("web_shop", 'Article').'</th><th>'.__d("web_shop", 'Price').'</th><th colspan="2">'.__d("web_shop", 'Amount').'</th>';
		echo '</tr>';
	
		//GET all products
		foreach ($data as $product){
			echo '<tr>';
			echo '<td>'.$this->Html->image($product['WebshopProduct']['picturePath'].$product['WebshopProduct']['picture'], array('class' => "webshop_cart_product_img")).'</td>';
			echo '<td>'.$this->Html->link($product['WebshopProduct']['name'], $url.'/webshop/view/'.$product['WebshopProduct']['id']).'</td>';
			echo '<td>'.$product['WebshopProduct']['price'].'</td>';
			echo '<td>'.$product['count'].'</td>';
			echo '<td>'.$this->Html->image('add2.png', array('url' => $url.'/webshop/add/'.$product['WebshopProduct']['id'], 'class' => "webshop_cart_icon")).$this->Html->image('remove.png',array('url' => $url.'/webshop/remove/'.$product['WebshopProduct']['id'], 'class' => "webshop_cart_icon")).'</td>';
			echo '</tr>';
		}
	
		echo '</table>';
	}
	
	//ORDER button
	if(!empty($data)){
		echo $this->Html->link(__d("web_shop", 'Submit Order'), $url.'/webshop/submitOrder/'.$pluginID, array('class' => 'webshop_submit_order'));
	}
		
	
	echo '</div>';