<!-- Create new products for the catalog -->
<?php 
	//TITLE
	echo '<h2>Artikel bearbeiten</h2>';

	//PRINT error/success messages
	$validationErrors = $this->Session->read('Validation.Product.validationErrors');
	//echo $this->Html->div('validation_error',$validationErrors);
	echo $this->Session->flash('Product');
	
	echo $this->Form->create('Product', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'WebShop', 'action' => 'edit', $contentID, $this->data['Product']['id']))); ?>
	<table>
		<tr>
			<td>
			<?php
		    	echo $this->Form->label('Name:');
		    ?>
			</td>
			<td>
			<?php
				echo $this->Form->input('name', array('label' => false, 'div' => ''));
			?>
			</td>
		</tr>
		<tr>
		<td>
			<?php
		    	echo $this->Form->label('Beschreibung:');
		    ?>
			</td>
			<td>
			<?php
				echo $this->Form->input('description', array('rows' => '4', 'label' => false, 'div' => ''));
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
		    	echo $this->Form->label('Preis:');
		    ?>
			</td>
			<td>
			<?php
				echo $this->Form->input('price', array('label' => false, 'div' => ''));
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
		    	echo $this->Form->label('Bild:');
		    ?>
			</td>
			<td>
			<?php
				echo $this->Form->file('Products.submittedfile', array('label' => false, 'div' => ''));
			?>
			</td>
		</tr>
	</table>
<?php echo $this->Form->end('Speichern'); ?>