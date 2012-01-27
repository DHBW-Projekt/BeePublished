<?php
	echo $this->element('admin_menu');
	$this->Html->script('jquery/jquery.sortable', false);
	$this->Html->script('/food_menu/js/sortable_menu_categories', false);
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuMenusFoodMenuCategories');
	echo $this->Form->hidden('menuID', array('value' => $menuID));
	echo $this->Session->flash();
	?>
	
	<div id="sortablelists">
	<h2><?php echo __d('food_menu', 'Drop categories on the left to add them to the menu'); ?></h2>
	<ul id="sortable1" class="connectedSortable">
	<?php
	if (sizeof($categories['used']) > 0) {
		foreach ($categories['used'] as $usedCategory) {
			echo '<li rel="' . $menuID . '" id="' . $usedCategory['FoodMenuCategory']['id'] .'">' . $usedCategory['FoodMenuCategory']['name'] . '</li>';
		} 
	}?>
	</ul>
 	<ul id="sortable2" class="connectedSortable">
	<?php 
 	if (sizeof($categories['notUsed']) > 0) {
		foreach ($categories['notUsed'] as $notUsedCategory) {
			echo '<li rel="' . $menuID . '" id="' . $notUsedCategory['FoodMenuCategory']['id'] .'">' . $notUsedCategory['FoodMenuCategory']['name'] . '</li>';
		} 
 	}?>

	</ul>
 	</div>
 	<?php 
	echo $this->Form->end();
?>