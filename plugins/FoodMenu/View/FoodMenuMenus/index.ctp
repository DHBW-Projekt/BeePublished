<div style="float:none; width:100%">
<?php
	$this->Html->script('jquery/jquery.quicksearch', false);
	$this->Html->script('/food_menu/js/foodmenu', false);
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {	
		echo $this->Form->create('FoodMenuCreateMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'create')));
		echo '<h1>'.(__d('food_menu', 'Create new menu')).'</h1>';
		echo $this->Form->end(__d('food_menu', 'New menu'));
		echo '<br /><hr /><br />';
	}
	echo '<h1>'.(__d('food_menu', 'Menus')).'</h1>';
	echo '<form>Search menu: <input type="text" id="search" /> </form>';
	echo $this->Form->create('FoodMenuMenu', array(
								'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'deleteMultiple'), 
								'onsubmit' => 'return confirm(\''. __d('food_menu', 'Do you really want to delete the selected menus?') .'\');'));

	?>
</div>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th><?php echo __d('food_menu', 'Name'); ?></th>
		<th><?php echo __d('food_menu', 'Valid from'); ?></th>
		<th><?php echo __d('food_menu', 'Valid until'); ?></th>
		<th> </th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (isset($menus)) {
		foreach ($menus as $menuEntry) {
			if ( $menuEntry['FoodMenuMenu']['deleted'] != NULL ) continue;
			else {
			echo '<tr>';
			echo '<td  class="tableicon">';
			if($deleteAllowed) echo $this->Form->checkbox($menuEntry['FoodMenuMenu']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false));
			echo '</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['name'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_from'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_until'].'</td>';
			echo '<td class="tableicon">';
			if($editAllowed) echo $this->Html->image('edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'edit', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td><td class="tableicon">';
			if($deleteAllowed) echo $this->Html->image('delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'delete', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td>';
		    echo '</tr>';
			}
		}
	}
	?>
	</tbody><?php
	if($deleteAllowed) { ?>
	<tfoot>
	<tr>
		<td><?php echo $this->Html->image('arrow.png', array('alt' => 'arrow')); ?></td>
		<td colspan="3"><?php echo $this->Form->submit(__d('food_menu', 'Delete')); ?></td>
	</tr>
	</tfoot><?php } ?>
	</table>
	<?php echo $this->Form->end(); ?>