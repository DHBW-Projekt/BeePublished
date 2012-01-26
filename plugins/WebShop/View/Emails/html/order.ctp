<div>
<p>Hi Admin,</p>
<p><?php echo $user['username']; ?> has submitted a new order.</p>
<p>E-Mail: <?php echo $user['email']; ?></p>

<p><strong>Order Details:</strong></p>

<table>
<tr>
	<th>Artikel</th>
	<th>Menge</th>
	<th>Einzelpreis</th>
	<th>Gesamtpreis</th>
</tr>

<?php
//Attributes
$pricePerProd = 0;
$totalPrice = 0;

//GET products
foreach ($order as $product){
	
	$pricePerProd = $product['WebshopProduct']['price'] * $product['count'];
	$totalPrice = $totalPrice + $pricePerProd;
	
	echo '<tr>';
	echo '<td>'.$product['WebshopProduct']['name'].' ('.$product['WebshopProduct']['id'].')</td>';
	echo '<td>'.$product['count'].'</td>';
	echo '<td>'.$product['WebshopProduct']['price'].'</td>';
	echo '<td>'.$pricePerProd.'</td>';
	echo '</tr>';
}
?>
<tr>
	<td style="text-align: right;" colspan="4"><strong>Bestellwert: <?php echo $totalPrice; ?></strong></td>
</tr>
</table>

<p>Yours sincerly,<br>
<?php echo $url?></p>
</div>