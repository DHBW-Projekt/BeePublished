<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
	echo $this->Session->flash();
	
	echo '<h1>'.__d('food_menu', 'Create category').'</h1>';
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	if($createAllowed){
		echo $this->Form->input('name', array('label' => (__d('food_menu', 'name:'))));
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>