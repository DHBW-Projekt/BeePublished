<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
	echo '<table class="create">';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('name', array('label' => (__('Name:')))).'<br />';
	echo $this->Form->input('description', array('type' => 'textarea', 'label' => (__('Description:')))).'<br />';
	echo $this->Form->input('price', array('label' => (__('Price:')))).'<br />';
	echo $this->Form->input('currency', array('label' => (__('Currency:')))).'<br />';
	echo '</td></tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->end();
?>