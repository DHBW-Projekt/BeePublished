<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuMenusFoodMenuCategories');
	echo $this->Form->hidden($menuID);
	echo $this->Session->flash();
	if (sizeof($categories['used']) > 0) {
	?>

<table>
	<thead>
	<tr>
		<th colspan="2"><?php echo __('Remove existing categories from menu'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($categories['used'] as $usedCategory) {
		echo '<tr>';
		echo '<td>' . $usedCategory['FoodMenuCategory']['name'] . '</td>';
		echo '<td>';
		if($deleteAllowed) echo $this->Html->image('delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenusFoodMenuCategories', 'action' => 'delete', $usedCategory['FoodMenuMenusFoodMenuCategory']['ID'])));
		echo '</td>';
		echo '</tr>';
	}?>
</tbody>
</table>
<?php
 	}//if sizeof

 	if (sizeof($categories['notUsed']) > 0) {
	?>
<table>
	<thead>
	<tr>
		<th colspan="2"><?php echo __('Add categories to menu'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($categories['notUsed'] as $notUsedCategory) {
		echo '<tr>';
		echo '<td>' . $notUsedCategory['FoodMenuCategory']['name'] . '</td>';
		echo '<td>';
		if($createAllowed) echo $this->Html->image('add.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenusFoodMenuCategories', 'action' => 'add', $notUsedCategory['FoodMenuCategory']['name'], $notUsedCategory['FoodMenuCategory']['id'], $menuID)));
		echo '</td>';
		echo '</tr>';
	}?>
</tbody>
</table>
<?php 	
 	} //if sizeof
	echo $this->Form->end();
?>