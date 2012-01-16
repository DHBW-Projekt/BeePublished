<!--  Produkt Administrations View -->
	<?php
	//LOAD js
	 $this->Html->script('/web_shop/js/admin', false); 
	
	//LOAD style-sheet
	echo $this->Html->css('/web_shop/css/webshop');
	
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
	?>
	
	<div id="webshop_product_administration">
		<h1>Offene Bestellungen</h1>	
		<table>
			<thead>
				<tr>
					<th>Bestellung</th>
					<th>Datum</th>
					<th>Status</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<?php
				if(empty($orders)){
					echo '<tr><td colspan="4">Keine offenen Bestellungen.</td></tr>';
				} else {
						
				//GET orders
				 foreach ($orders as $order): 
					
					if($order['WebshopOrder']['status'] == 0)
						$status = 'offen';
					else if ($order['WebshopOrder']['status'] == 1)
						$status = 'bearbeitet';
			
				    echo '<tr>';
				    
				    //GET detailed order info
					echo '<td>';
						echo '<p><strong>Bestellung:</strong> '.$order['WebshopOrder']['id'].'</p>';
						echo '<p style="margin-bottom:10px"><strong>Kunde:</strong> '.$order['User']['username'].' (ID: '.$order['User']['id'].')</p>';

						echo '<table>';
						echo '<tr>';
						echo '<th>Artikel</th>';
						echo '<th>Menge</th>';
						echo '<th>Einzelpreis</th>';
						echo '<th>Gesamtpreis</th>';
						echo '</tr>';
						
						//Attributes
						$pricePerProd = 0;
						$totalPrice = 0;
						
						foreach ((!isset($order['WebshopPosition'])) ? array() : $order['WebshopPosition'] as $position) {
							$pricePerProd = $position['Product']['WebshopProduct']['price'] * $position['count'];
							$totalPrice = $totalPrice + $pricePerProd;
							
							echo '<tr>';
							echo '<td>'.$position['Product']['WebshopProduct']['name'].' (ID: '.$position['Product']['WebshopProduct']['id'].')</td>';
							echo '<td>'.$position['count'].' Stck.</td>';
							echo '<td>'.number_format($position['Product']['WebshopProduct']['price'], 2, ',', '.').' '.$position['Product']['WebshopProduct']['currency'].'</td>';
							echo '<td>'.number_format($pricePerProd, 2, ',', '.').' '.$position['Product']['WebshopProduct']['currency'].'</td>';
							echo '</tr>';
						}
						
						echo '<tr>';
						echo '<td style="text-align: right; padding-top:15px" colspan="4"><strong>Bestellwert: '.number_format($totalPrice, 2, ',', '.').' '.$position['Product']['WebshopProduct']['currency'].'</strong></td>';
						echo '</tr>';
						echo '</table>';
					echo '</td>';
					
					
					echo '<td>'.$order['WebshopOrder']['created'].'</td>';
					echo '<td><p style="font-style: italic;">'.$status.'</p></td>';
					echo '<td>'.$this->Html->link(
					    			   $this->Html->image("check.png"), 
					    					array('action' => 'closeOrder', $contentID, $order['WebshopOrder']['id']),
					    					array('escape' => False)
					    			    ).'</td>';
				   echo '</tr>';
				   
				endforeach; 
			}
			?>
		</table>
	</div>