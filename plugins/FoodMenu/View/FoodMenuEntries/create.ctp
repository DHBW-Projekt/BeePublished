<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo '<h1>'.__d('food_menu', 'Create entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
		echo $this->Form->input('name', array('label' => (__d('food_menu', 'Name:')))).'<br />';
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'label' => (__d('food_menu', 'Description:')))).'<br />';
		echo $this->Form->input('price', array('label' => (__d('food_menu', 'Price:')))).'<br />';
		$options = array(
					'EUR' => __d('food_menu', 'Euro'), 
					'USD' => __d('food_menu', 'US Dollar'), 
					'CAD' => __d('food_menu', 'Canadian Dollar'), 
					'GBP' => __d('food_menu', 'Great Britain Pound'), 
					'CHF' => __d('food_menu', 'Swiss Frank')
					);
		echo $this->Form->label(__d('food_menu', 'Currency:'));
		echo $this->Form->select('currency', $options) . '<br />';
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>