<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntry', 'action' => 'create')));
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('name').'<br />';
	echo $this->Form->textarea('description').'<br />';
	echo $this->Form->input('price').'<br />';
	echo $this->Form->input('currency').'<br />';
	echo '</td></tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->button(__('Back'), array('type' => 'button', 'onClick' => 'window.history.back()'));
	echo $this->Form->end();
?>