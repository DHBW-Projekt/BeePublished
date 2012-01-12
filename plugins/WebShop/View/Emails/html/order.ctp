<div>
<p>Hi Admin,</p>
<p>XXX has submitted a new order.</p>

<p><strong>Order Details:</strong></p>

<table>
<tr>
	<th>Product</th>
	<th>Preis</th>
	<th>Menge</th>
	<th>Gesamtpreis</th>
</tr>

<?php
//Attributes
$pricePerProd = 0;
$totalPrice = 0;


//GET products
foreach($order as $product){
	
	$pricePerProd = $product['Product']['price'] * $product['Product']['count'];
	$totalPrice = $totalPrice + $pricePerProd;
	
	echo '<tr>';
		echo '<td>'.$product['Product']['name'].' ('.$product['Product']['id'].')</td>';
		echo '<td>'.$product['Product']['price'].'</td>';
		echo '<td>'.$product['Product']['count'].'</td>';
		echo '<td>'.$pricePerProd.'</td>';
	echo '</tr>';
}
?>
</table>

<p><strong>Gesamt Wert: <?php echo $totalPrice; ?></strong></p>

<p>Yours sincerly,<br>
<?php echo $url?></p>
</div>