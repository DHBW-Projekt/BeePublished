<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
	echo $this->Session->flash();
	echo $this->Form->input('name', array('label' => (__('name:'))));
	echo $this->Form->end(__('Save'));
?>