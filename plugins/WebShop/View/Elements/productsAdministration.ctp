<h1>
	Produkte
	<?php 
    	echo $this->Html->link(
    				$this->Html->image("add2.png", array('width' => '32px')), 
    				array('action' => 'create', $contentID),
    				array('escape' => False)
    	);
    ?>
</h1>

<table>
	<tr>
		<th>Name</th>
		<th>Preis</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach ($products as $product): ?>
	    <tr>
		    <td>
		    	<?php echo $product['Product']['name']; ?>
		    </td>
		    <td>
		    	<?php echo $product['Product']['price']; ?>
		    </td>
		    <td>
		    	<?php 
		    		echo $this->Html->link(
		    					$this->Html->image("edit.png", array('width' => '32px')), 
		    					array('action' => 'edit', $contentID, $product['Product']['id']),
		    					array('escape' => False)
		    		);
		    	?>
		    </td>
		    <td>
		    	<?php 
		    		echo $this->Html->link(
		    					$this->Html->image("remove.png", array('width' => '32px')), 
		    					array('action' => 'remove', $contentID, $product['Product']['id']),
		    					array('escape' => False)
		    		);
		    	?>
		    </td>
	    </tr>
	<?php endforeach; ?>
</table>