<div id="adminEntryOverview">
	<?php 
		$this->Html->script('jquery/jquery.quicksearch', false);
		$this->Html->script('/food_menu/js/foodmenu', false);
		echo $this->element('admin_menu');
		
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
		
		if($createAllowed) {
			echo $this->Form->create('FoodMenuCreateEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
			echo '<h1>'.(__('Create new entry')).'</h1>';
			echo $this->Form->end(__('New entry'));
			echo '<br /><hr /><br />';
		}
		echo '<h1>'.(__('Entries')).'</h1>';
		echo '<form>Search entry: <input type="text" id="search" /> </form>';
		echo $this->Form->create('FoodMenuEntry', array(
								'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'deleteMultiple'), 
								'onsubmit' => 'return confirm(\''. __('Do you really want to delete the selected entries?') .'\');'));

	?>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Currency'); ?></th>
		<th> </th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (isset($entries)) {
	foreach ($entries as $entry) {
		if ( $entry['FoodMenuEntry']['deleted'] != NULL ) continue;
		else {
		echo '<tr>';
		echo '<td  class="tableicon">';
		if($deleteAllowed) echo $this->Form->checkbox($entry['FoodMenuEntry']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false));
		echo '</td>';
		echo '<td>'.$entry['FoodMenuEntry']['name'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['price'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['currency'].'</td>';
		echo '<td class="tableicon">';
		if($editAllowed) echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td><td class="tableicon">';
		if($deleteAllowed) echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'delete', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td>';
	    echo '</tr>';
		}
	}
	}
	?>
	</tbody>
	<?php
	if($deleteAllowed) { ?>
	<tfoot>
	<tr>
		<td><?php echo $this->Html->image('/app/webroot/img/arrow.png', array('alt' => 'arrow')); ?></td>
		<td colspan="3"><?php echo $this->Form->submit(__('Delete')); ?></td>
	</tr>
	</tfoot>
	<?php } ?>
	</table>
	<br />
	<?php echo $this->Form->end(); ?>
</div>