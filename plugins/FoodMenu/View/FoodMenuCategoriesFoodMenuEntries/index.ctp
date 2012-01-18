<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategoriesFoodMenuEntries');
	echo $this->Form->hidden($categoryID);
	echo $this->Session->flash();
	if (sizeof($entries['used']) > 0) {
	?>
<h1><?php echo __('Add entries to categories'); ?></h1>
<table>
	<thead>
	<tr>
		<th colspan="2"><?php echo __('Remove existing entries from category'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($entries['used'] as $usedEntry) {
		echo '<tr>';
		echo '<td>' . $usedEntry['FoodMenuEntry']['name'] . '</td>';
		echo '<td>';
		if ($deleteAllowed) echo $this->Html->image('delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategoriesFoodMenuEntries', 'action' => 'delete', $usedEntry['FoodMenuCategoriesFoodMenuEntry']['ID'])));
		echo '</td>';
		echo '</tr>';
	}?>
</tbody>
</table>
<?php
 	}//if sizeof

 	if (sizeof($entries['notUsed']) > 0) {
	?>
<table>
	<thead>
	<tr>
		<th colspan="2"><?php echo __('Add entries to category'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($entries['notUsed'] as $notUsedEntry) {
		echo '<tr>';
		echo '<td>' . $notUsedEntry['FoodMenuEntry']['name'] . '</td>';
		echo '<td>';
		if ($createAllowed) echo $this->Html->image('add.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategoriesFoodMenuEntries', 'action' => 'add', $notUsedEntry['FoodMenuEntry']['name'], $notUsedEntry['FoodMenuEntry']['id'], $categoryID)));
		echo '</td>';
		echo '</tr>';
	}?>
</tbody>
</table>
<?php 	
 	} //if sizeof
	echo $this->Form->end();
?>