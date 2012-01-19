<!--  Produkt Administrations View -->
	<?php	
	
	//LOAD js
	$this->Html->script('jquery/jquery.quicksearch', false);
	$this->Html->script('/web_shop/js/admin', false); 
	
	//LOAD style-sheet
	echo $this->Html->css('/WebShop/css/webshop');
	
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
	?>
	
	<div id="webshop_product_administration">		
		<h2><?php echo __d("web_shop", "Create new product").":"; ?></h2>

		<?php 
			echo $this->Form->create('createProduct', array('url' => array('controller' => 'WebShop', 'action' => 'create', $contentID)));
			echo $this->Form->end(__d("web_shop", 'Create product'));
		?>
		
		<br><hr><br>
		<h2><?php echo __d("web_shop", "Products").":"; ?></h2>
		<br>
		
		<?php 
			echo $this->Session->flash('WebshopProduct');
			
			echo $this->Form->create('search');
			echo $this->Form->input('WebshopProduct.name', array('label' => (__d('web_shop', 'Search Products').":"), 'id' => 'search_products'));
			echo $this->Form->end();
		?>
		
		<table id="products">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __d("web_shop", "Product"); ?></th>
					<th><?php echo __d("web_shop", "Date"); ?></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					echo $this->Form->create('selectedProducts', array(
						'url' => array('controller' => 'WebShop', 'action' => 'removeSelected', $contentID),
						'onsubmit'=>'return confirm(\''.__d('web_shop', 'Do you really want to delete the selected products?').'\');'));
				?>
				<?php foreach ($products as $product): ?>
				    <tr>
				    	<td><?php echo $this->Form->checkbox($product['WebshopProduct']['id']); ?></td>
					    <td><?php echo $product['WebshopProduct']['name']; ?></td>
					    <td><?php echo $product['WebshopProduct']['created']; ?></td>
					    <td class="webshop_orientation_right">
					    	<?php echo $this->Html->link(
					    			 		$this->Html->image("edit.png"), 
					    					array('action' => 'edit', $contentID, $product['WebshopProduct']['id']),
					    					array('escape' => False)
					    				);?>
					    </td>
					    <td class="webshop_orientation_right">
					    	<?php echo $this->Html->link(
					    					$this->Html->image("delete.png"), 
					    					array('action' => 'remove', $contentID, $product['WebshopProduct']['id']),
					    					array('escape' => False)
					    				);?>
					    </td>
				    </tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td><?php echo $this->Html->image('arrow.png', array('height' => 20, 'width' => 20)); ?></td>
					<td><?php echo $this->Form->end(__d('web_shop', 'Delete'), array('height' => 20, 'width' => 20, 'alt' => __d('web_shop', 'Delete'))); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>