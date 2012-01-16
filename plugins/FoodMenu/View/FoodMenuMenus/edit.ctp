<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'edit')), array('class' => 'edit'));
	echo $this->Form->hidden('id', array('value' => $menu['FoodMenuMenu']['id']));
	echo $this->Session->flash();
	echo '<ul class="buttonlink">';
	echo '<li>'.$this->Html->link((__('Add Categories')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenusFoodMenuCategories', 'action' => 'index', $menu['FoodMenuMenu']['name'], $menu['FoodMenuMenu']['id']), array('class' => 'buttonlink')).'</li>';
	echo '</ul>';
	echo '<table class="edit">';
	echo '<tr>';
		echo '<td>'.$this->Form->input('name', array('value' => $menu['FoodMenuMenu']['name'], 'label' => (__('Name:')))).'</td>';
	echo '</tr><tr>';
		echo '<td>'.$this->Form->input('valid_from', array('value' => $menu['FoodMenuMenu']['valid_from'], 'selected'=>$menu['FoodMenuMenu']['valid_from'], 'label' => (__('Valid From:')))).'</td>';
	echo '</tr><tr>';
		echo '<td>'.$this->Form->input('valid_until', array('value' => $menu['FoodMenuMenu']['valid_until'], 'selected'=>$menu['FoodMenuMenu']['valid_until'], 'label' => (__('Valid until:')))).'</td>';
	echo '</tr><tr>';
		echo '<td>';
		echo $this->Form->label(__('Valid on weekday:'));
			$days = $menu['FoodMenuMenu']['food_menu_series_id'];
			if ($days >= 64) {
				$su = true;
				$days = $days - 64;
			} else $su = false;
			if($days >= 32) {
				$sa = true;
				$days = $days - 32;
			} else $sa = false;
			if($days >= 16) {
				$fr = true;
				$days = $days - 16;
			} else $fr = false;
			if($days >= 8) {
				$th = true;
				$days = $days - 8;
			} else $th = false;
			if($days >= 4) {
				$we = true;
				$days = $days - 4;
			} else $we = false;
			if($days >= 2) {
				$tu = true;
				$days = $days - 2;
			} else $tu = false;
			if($days >= 1) {
				$mo = true;
				$days = $days - 1;
			} else $mo = false;
		
		echo __('Mon:').' '.$this->Form->checkbox('mo', array('class' => 'adminCheckbox', 'value' => 1, 'checked' => $mo, 'hiddenField' => true));
		echo __('Tue:').' '.$this->Form->checkbox('tu', array('class' => 'adminCheckbox', 'value' => 2, 'checked' => $tu, 'hiddenField' => true));
		echo __('Wed:').' '.$this->Form->checkbox('we', array('class' => 'adminCheckbox', 'value' => 4, 'checked' => $we, 'hiddenField' => true));
		echo __('Thu:').' '.$this->Form->checkbox('th', array('class' => 'adminCheckbox', 'value' => 8, 'checked' => $th, 'hiddenField' => true));
		echo __('Fri:').' '.$this->Form->checkbox('fr', array('class' => 'adminCheckbox', 'value' => 16, 'checked' => $fr, 'hiddenField' => true));
		echo __('Sat:').' '.$this->Form->checkbox('sa', array('class' => 'adminCheckbox', 'value' => 32, 'checked' => $sa, 'hiddenField' => true));
		echo __('Sun:').' '.$this->Form->checkbox('su', array('class' => 'adminCheckbox', 'value' => 64, 'checked' => $su, 'hiddenField' => true));
		echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->end();
?>