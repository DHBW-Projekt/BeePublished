<h1>Create new location</h1>

<?php echo $this->Form->create('GoogleMapsLocation', array('url' => array('controller' => 'Location', 'action' => 'create', $contentID))); ?>
<table>
    <tr>
    	<td>
			<?php echo $this->Form->label('Street:'); ?>
		</td>
	    <td>
	    	<?php echo $this->Form->input('street', array('label' => false)); ?>
	    </td>
	</tr>
	<tr>
    	<td>
			<?php echo $this->Form->label('Street Number:'); ?>
		</td>
	    <td>
	    	<?php echo $this->Form->input('street_number', array('label' => false)); ?>
	    </td>
	</tr>
	<tr>
    	<td>
			<?php echo $this->Form->label('ZIP Code:'); ?>
		</td>
	    <td>
	    	<?php echo $this->Form->input('zip_code', array('label' => false)); ?>
	    </td>
	</tr>
	<tr>
    	<td>
			<?php echo $this->Form->label('City:'); ?>
		</td>
	    <td>
	    	<?php echo $this->Form->input('city', array('label' => false)); ?>
	    </td>
	</tr>
	<tr>
    	<td>	
			<?php echo $this->Form->label('Country:'); ?>
		</td>
	    <td>
	    	<?php echo $this->Form->input('country', array('label' => false)); ?>
	    </td>
    </tr>
</table>
<?php echo $this->Form->submit(__('Speichern', true), array('name' => 'save', 'div' => false)); ?>
<?php echo $this->Form->submit(__('Abbrechen', true), array('name' => 'cancel', 'div' => false)); ?>
<?php echo $this->Form->end();?>