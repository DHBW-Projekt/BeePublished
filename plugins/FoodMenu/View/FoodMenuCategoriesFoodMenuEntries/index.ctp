<?php
	echo $this->element('admin_menu');
	$this->Html->script('jquery/jquery.sortable', false);
	$this->Html->script('/food_menu/js/sortable_category_entries', false);
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategoriesFoodMenuEntries');
	echo $this->Form->hidden('categoryID', array('value' => $categoryID));
	echo $this->Session->flash();
	?>
	
	<div id="sortablelists">
	<h2><?php echo __d('food_menu', 'Drop entries on the left to add them to the category'); ?></h2>
	<ul id="sortable1" class="connectedSortable">
	<?php
	if (sizeof($entries['used']) > 0) {
		foreach ($entries['used'] as $usedEntry) {
			echo '<li id="' . $usedEntry['FoodMenuEntry']['id'] .'">' . $usedEntry['FoodMenuEntry']['name'] . '</li>';
		} 
	}?>
	</ul>
 	<ul id="sortable2" class="connectedSortable">
	<?php 
 	if (sizeof($entries['notUsed']) > 0) {
		foreach ($entries['notUsed'] as $notUsedEntry) {
			echo '<li id="' . $notUsedEntry['FoodMenuEntry']['id'] .'">' . $notUsedEntry['FoodMenuEntry']['name'] . '</li>';
		} 
 	}?>
	</ul>
 	</div>
 	<?php 
	echo $this->Form->end();
?>