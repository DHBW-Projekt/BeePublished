<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	if($editAllowed){
		echo '<h1>'.__('Edit entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit')));
		echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
		echo $this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'], 'label' => (__('Name:'))));
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'value' => $entry['FoodMenuEntry']['description'], 'label' => (__('Description:'))));
		echo $this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'], 'label' => (__('Price:'))));
		//echo $this->Form->input('currency', array('value' => $entry['FoodMenuEntry']['currency'], 'label' => (__('Currency:'))));
		$options = array(
					'EUR' => __('Euro'), 
					'USD' => __('US Dollar'), 
					'CAD' => __('Canadian Dollar'), 
					'GBP' => __('Great Britain Pound'), 
					'CHF' => __('Swiss Frank')
					);
		echo $this->Form->label(__('Currency:'));
		echo $this->Form->select('currency', $options, array('selected' => $entry['FoodMenuEntry']['currency'])) . '<br />';
		echo $this->Form->end(__('Save'));
		echo $entry['FoodMenuEntry']['currency'];
	}
?>