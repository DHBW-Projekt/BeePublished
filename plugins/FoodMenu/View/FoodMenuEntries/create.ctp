<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
	echo $this->Form->input('name', array('label' => (__('Name:')))).'<br />';
	echo $this->Form->input('description', array('type' => 'textarea', 'label' => (__('Description:')))).'<br />';
	echo $this->Form->input('price', array('label' => (__('Price:')))).'<br />';
	echo $this->Form->input('currency', array('label' => (__('Currency:')))).'<br />';
	echo $this->Form->end(__('Save'));
?>