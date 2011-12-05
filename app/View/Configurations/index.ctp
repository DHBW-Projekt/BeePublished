
<?php echo $this->Form->create('Configuration'); ?>
<?php foreach ($configurations as $configuration): ?>
<?php echo $this->Form->input($configuration['Configuration']['key'], array('value' => $configuration['Configuration']['value']));?>
<?php endforeach; ?>
<?php echo $this->Form->end(__('Save Configurations')); ?>	

<table>
<tr><th>Key</th><th>Value</th></tr>
<?php foreach ($configurations as $configuration): ?>
<tr>
	<td><?php echo $configuration['Configuration']['key'];?></td>
	<td><?php echo $configuration['Configuration']['value']; ?></td>
</tr>
<?php endforeach; ?>
</table>

<pre>
<?php 
print_r($configurations)
?>
</pre>