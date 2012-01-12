<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'create')));
	echo $this->Session->flash();
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	
		echo $this->Form->input('name', array('value' => '')).'<br />';
		echo $this->Form->input('valid_from').'<br />';
		echo $this->Form->input('valid_until').'<br />';
	
	echo '</td>';
	echo '</tr><tr>';
	echo '<td>';
	echo 'Tage:<br/ >';
		echo 'Mo: '.$this->Form->checkbox('mo', array('value' => 1, 'checked' => true, 'hiddenField' => true));
		echo 'Di: '.$this->Form->checkbox('tu', array('value' => 2, 'checked' => true, 'hiddenField' => true));
		echo 'Mi: '.$this->Form->checkbox('we', array('value' => 4, 'checked' => true, 'hiddenField' => true));
		echo 'Do: '.$this->Form->checkbox('th', array('value' => 8, 'checked' => true, 'hiddenField' => true));
		echo 'Fr: '.$this->Form->checkbox('fr', array('value' => 16, 'checked' => true, 'hiddenField' => true));
		echo 'Sa: '.$this->Form->checkbox('sa', array('value' => 32, 'checked' => true, 'hiddenField' => true));
		echo 'So: '.$this->Form->checkbox('su', array('value' => 64, 'checked' => true, 'hiddenField' => true));
	echo '</td></tr>';
	echo '</table>';
		echo $this->Form->button(__('Save'), array('type' => 'submit'));
		echo $this->Form->button(__('Back'), array('type' => 'button', 'onClick' => 'window.history.back()'));
	echo $this->Form->end();
?>
