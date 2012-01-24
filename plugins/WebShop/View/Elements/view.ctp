<!-- Web-Shop product detail view -->
	<?php
		$this->Helpers->load('BBCode');
		$this->Helpers->load('SocialNetwork');
		
		echo $this->element('SearchBar', array('url' => $url));
	?>
		
	<div id="webshop_detailview">'
		<?php echo $this->Html->image('/WebShop/img/products/'.$data['WebshopProduct']['picture'], array('class' => "webshop_detailview_image", 'style' => "margin-right: 10px")); ?>
		<h2><?php echo $data['WebshopProduct']['name'] ?></h2>
		
		<table class="webshop_infobox">
			<tr>
				<td class="websop_price">
					<?php echo __d("web_shop", 'Price').': '.$data['WebshopProduct']['price'].' '.$data['WebshopProduct']['currency']; ?>
				</td>
				<td class="webshop_cart_add">
					<?php echo $this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => $url.'/webshop/add/'.$data['WebshopProduct']['id'], 'class' => "webshop_cart_icon")); ?>
				</td>
			</tr>
		</table>
		
		<div>
			<?php 
				echo $this->SocialNetwork->insertFacebookShare();
				echo $this->SocialNetwork->insertGoogleShare();
				echo $this->SocialNetwork->insertTwitterShare();
			?>
		</div>
		
		<br style="clear:left">
		
		<?php echo $this->BBCode->transformBBCode($data['WebshopProduct']['description']); ?>
	</div>