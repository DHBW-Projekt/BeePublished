<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit')));
	echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
	echo $this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'], 'label' => (__('Name:'))));
	echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'value' => $entry['FoodMenuEntry']['description'], 'label' => (__('Description:'))));
	echo $this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'], 'label' => (__('Price:'))));
	echo $this->Form->input('currency', array('value' => $entry['FoodMenuEntry']['currency'], 'label' => (__('Currency:'))));
	echo $this->Form->end(__('Save'));
?>