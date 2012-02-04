<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Wuerttemberg Mannheim
 * @author Maximilian Stueber and Patrick Zamzow
 *
 * @description Web-Shop E-Mail-Template.
 */
?>

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