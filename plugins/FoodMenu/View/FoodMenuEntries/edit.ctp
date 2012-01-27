<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	if($editAllowed){
		echo '<h1>'.__d('food_menu', 'Edit entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit')));
		echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
		echo $this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'], 'label' => (__d('food_menu', 'Name:'))));
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'value' => $entry['FoodMenuEntry']['description'], 'label' => (__d('food_menu', 'Description:'))));
		echo $this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'], 'label' => (__d('food_menu', 'Price:'))));
		$options = array(
					'EUR' => __d('food_menu', 'Euro'), 
					'USD' => __d('food_menu', 'US Dollar'), 
					'CAD' => __d('food_menu', 'Canadian Dollar'), 
					'GBP' => __d('food_menu', 'Great Britain Pound'), 
					'CHF' => __d('food_menu', 'Swiss Frank')
					);
		echo $this->Form->label(__d('food_menu', 'Currency:'));
		echo $this->Form->select('currency', $options, array('default' => $entry['FoodMenuEntry']['currency'])) . '<br />';
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>