Hi Admin,

XXX has submitted a new order.

Order Details:

<?php 
//Attributes
$pricePerProd = 0;
$totalPrice = 0;

//GET products
foreach($order as $product){
	
	$pricePerProd = Product.price * $productID['count'];
	$totalPrice = $totalPrice + $pricePerProd;
	
	echo $product['Product']['name'].' ('.$product['Product']['id'].'): Einzelpreis: '.Product.price.' Menge '.$productID['count'].' Preis: '.$pricePerProd;
	echo '<br>';
}
?>


Yours sincerly,
<?php echo $url?>