<?php
	echo $this->element('PluginMenu');
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'editCategory')));
	echo $this->Form->hidden('id', array('value' => $category['FoodMenuCategory']['id']));
	echo $this->Session->flash();
	echo '<table>';
	echo '<tr>';
	echo '<td>'.$this->Form->input('name', array('value' => $category['FoodMenuCategory']['name'])).'</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->button(__('Back'), array('type' => 'button', 'onClick' => 'window.history.back()'));
	echo $this->Form->end();
?>