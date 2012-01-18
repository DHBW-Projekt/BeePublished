<table style="width:100.01%">
	<tr>
		<th> </th>
		<th><?php echo __('Name:'); ?></th>
		<th> </th>
	</tr>
	<tr>
		<td><?php echo $this->Form->checkbox($preferences['Preferences']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false));?></td>
		<td><?php echo __('Preis anzeigen'); ?></td>
		<td> </td>
	</tr>

<?php
// import array with possible preferences

?>
</table>