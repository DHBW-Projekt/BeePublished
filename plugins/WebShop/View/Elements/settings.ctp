<?php echo $this->Form->create('ContentValues', array('url' => array('controller' => 'WebShop', 'action' => 'setContentValues', $contentID))); ?>
    <table>
    	<tr>
    		<td>
    			<?php echo $this->Form->label('Produktanzahl:'); ?>
    		</td>
    		<td>
    			<?php
    				if (!isset($numberOfEntries)) {
    					$numberOfEntries = "";
    				} 
    				echo $this->Form->input('NumberOfEntries', array('label' => false, 'value' => $numberOfEntries)); 
    			?>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<?php echo $this->Form->end('Speichern'); ?>
			</td>
		</tr>
	</table>