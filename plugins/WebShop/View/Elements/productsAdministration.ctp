<!--  Produkt Administrations View -->
<div id="webshop_product_administration">
<h1>Produkt-Administration</h1>
<table>
	<tr>
		<th>Name</th>
		<th>Preis</th>
		<th colspan="2">Aktionen</th>
	</tr>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo $product['Product']['name']; ?></td>
		<td><?php echo $product['Product']['price']; ?></td>
		<td><?php echo $this->Html->link(
		$this->Html->image("edit.png", array('width' => '32px')),
		array('action' => 'edit', $contentID, $product['Product']['id']),
		array('escape' => False)
		);?></td>
		<td><?php echo $this->Html->link(
		$this->Html->image("delete.png", array('width' => '32px')),
		array('action' => 'remove', $contentID, $product['Product']['id']),
		array('escape' => False)
		);?></td>
	</tr>
	<?php endforeach; ?>
</table>

	<?php echo $this->Form->postLink("Neues Produkt", array('action' => 'create', $contentID), array('style' => "font-weight: bold")); ?>
</div>
