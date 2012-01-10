<?php echo $this->Form->create('ContentValues', array('url' => array('controller' => 'WebShop', 'action' => 'setContentValues'))); ?>
    <table>
    	<tr>
    		<td>
    			<?php echo $this->Form->label('Start Bereich:'); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('DefaultView', array('options' => array("Product Overview"), 'empty' => '(wähle aus)', 'label' => false)); ?>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<?php echo $this->Form->label('Produktanzahl:'); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('NumberOfProductsInList', array('label' => false)); ?>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<?php echo $this->Form->end('Speichern'); ?>
			</td>
		</tr>
	</table>