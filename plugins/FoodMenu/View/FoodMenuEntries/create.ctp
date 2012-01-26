<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo '<h1>'.__('Create entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
		echo $this->Form->input('name', array('label' => (__('Name:')))).'<br />';
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'label' => (__('Description:')))).'<br />';
		echo $this->Form->input('price', array('label' => (__('Price:')))).'<br />';
		$options = array(
					'EUR' => __('Euro'), 
					'USD' => __('US Dollar'), 
					'CAD' => __('Canadian Dollar'), 
					'GBP' => __('Great Britain Pound'), 
					'CHF' => __('Swiss Frank')
					);
		echo $this->Form->label(__('Currency:'));
		echo $this->Form->select('currency', $options) . '<br />';
		echo $this->Form->end(__('Save'));
	}
?>