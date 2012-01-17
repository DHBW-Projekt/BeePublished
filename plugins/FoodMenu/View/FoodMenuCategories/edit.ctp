<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'edit')));
	echo $this->Form->hidden('id', array('value' => $category['FoodMenuCategory']['id']));
	echo $this->Session->flash();
	echo '<ul class="buttonlink">';
	echo '<li>'.$this->Html->link((__('Add Entries')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategoriesFoodMenuEntries', 'action' => 'index', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id']), array('class' => 'buttonlink')).'</li>';
	echo '</ul>';
	echo $this->Form->input('name', array('value' => $category['FoodMenuCategory']['name'], 'label' => (__('Name:'))));
	echo $this->Form->end(__('Save'));
?>