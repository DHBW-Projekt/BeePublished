<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit')));
	echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
	echo '<table class="edit">';
	echo '<tr>';
	echo '<td>'.$this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'], 'label' => (__('Name:')))).'</td>';
	echo '</tr><tr>';
	echo '<td>'.$this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'value' => $entry['FoodMenuEntry']['description'], 'label' => (__('Description:')))).'</td>';
	echo '</tr><tr>';
	echo '<td>'.$this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'], 'label' => (__('Price:')))).'</td>';
	echo '</tr><tr>';
	echo '<td>'.$this->Form->input('currency', array('value' => $entry['FoodMenuEntry']['currency'], 'label' => (__('Currency:')))).'</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->end();
?>