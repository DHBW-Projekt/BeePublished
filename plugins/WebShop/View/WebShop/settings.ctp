<?php
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<?php echo $this->Form->create('ContentValues', array('url' => array('controller' => 'WebShop', 'action' => 'setContentValues', $contentID))); ?>
    <table>
    	<tr>
    		<td>
    			<?php echo $this->Form->label('Produktanzahl:'); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('NumberOfEntries', array('label' => false)); ?>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<?php echo $this->Form->end('Speichern'); ?>
			</td>
		</tr>
	</table>