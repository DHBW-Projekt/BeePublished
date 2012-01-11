<?php
	echo $this->element('PluginMenu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'editEntry')));
	echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
	echo '<table>';
	echo '<tr>';
	echo '<td>'.$this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'])).'</td>';
	echo '<td>'.$this->Form->textarea('description', array('value' => $entry['FoodMenuEntry']['description'])).'</td>';
	echo '<td>'.$this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'])).'</td>';
	echo '<td>'.$this->Form->input('currency', array('value' => $entry['FoodMenuEntry']['currency'])).'</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->button(__('Back'), array('type' => 'button', 'onClick' => 'window.history.back()'));
	echo $this->Form->end();
?>