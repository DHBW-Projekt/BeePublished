<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
	echo $this->Session->flash();
	
	echo '<h1>'.__('Create category').'</h1>';
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	if($createAllowed){
		echo $this->Form->input('name', array('label' => (__('name:'))));
		echo $this->Form->end(__('Save'));
	}
?>