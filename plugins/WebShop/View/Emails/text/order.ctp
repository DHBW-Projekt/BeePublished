Hi Admin,

XXX has submitted a new order.

Order Details:

<?php 
//Attributes
$pricePerProd = 0;
$totalPrice = 0;

//GET products
foreach ($order as $product){

	$pricePerProd = $product['WebshopProduct']['price'] * $product['count'];
	$totalPrice = $totalPrice + $pricePerProd;

	echo '<p>'.$product['WebshopProduct']['name'].' ('.$product['WebshopProduct']['id'].'): '.$product['count'].' * '.$product['WebshopProduct']['price'].'</p>';
}
?>
<p style="margin-top:10px"><strong>Bestellwert: <?php echo $totalPrice; ?></strong></p>

Yours sincerly,
<?php echo $url?>