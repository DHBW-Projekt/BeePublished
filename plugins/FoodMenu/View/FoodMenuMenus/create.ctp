<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'create')));
		echo $this->Session->flash();
			echo $this->Form->input('name', array('label' => (__('Name:')))).'<br />';
			echo $this->Form->input('valid_from', array('label' => (__('Valid from:')))).'<br />';
			echo $this->Form->input('valid_until', array('label' => (__('Valid until:')))).'<br />';
		echo $this->Form->label(__('Valid on weekday:'));
			echo __('Mon:').' '.$this->Form->checkbox('mo', array('class' => 'adminCheckbox', 'value' => 1, 'checked' => true, 'hiddenField' => true));
			echo __('Tue:').' '.$this->Form->checkbox('tu', array('class' => 'adminCheckbox', 'value' => 2, 'checked' => true, 'hiddenField' => true));
			echo __('Wed:').' '.$this->Form->checkbox('we', array('class' => 'adminCheckbox', 'value' => 4, 'checked' => true, 'hiddenField' => true));
			echo __('Thu:').' '.$this->Form->checkbox('th', array('class' => 'adminCheckbox', 'value' => 8, 'checked' => true, 'hiddenField' => true));
			echo __('Fri:').' '.$this->Form->checkbox('fr', array('class' => 'adminCheckbox', 'value' => 16, 'checked' => true, 'hiddenField' => true));
			echo __('Sat:').' '.$this->Form->checkbox('sa', array('class' => 'adminCheckbox', 'value' => 32, 'checked' => true, 'hiddenField' => true));
			echo __('Sun:').' '.$this->Form->checkbox('su', array('class' => 'adminCheckbox', 'value' => 64, 'checked' => true, 'hiddenField' => true));
		echo $this->Form->end(__('Save'));
	}
?>
