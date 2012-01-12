<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'edit')));
	echo $this->Form->hidden('id', array('value' => $menu['FoodMenuMenu']['id']));
	echo $this->Session->flash();
	echo '<table>';
	echo '<tr>';
		echo '<td>'.$this->Form->input('name', array('value' => $menu['FoodMenuMenu']['name'])).'</td>';
	echo '</tr><tr>';
		echo '<td>'.$this->Form->input('valid_from', array('value' => $menu['FoodMenuMenu']['valid_from'], 'selected'=>$menu['FoodMenuMenu']['valid_from'])).'</td>';
	echo '</tr><tr>';
		echo '<td>'.$this->Form->input('valid_until', array('value' => $menu['FoodMenuMenu']['valid_until'], 'selected'=>$menu['FoodMenuMenu']['valid_until'])).'</td>';
	echo '</tr><tr>';
		echo '<td>';
		echo 'Tage:<br/ >';
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
		
		echo 'Mo: '.$this->Form->checkbox('mo', array('value' => 1, 'checked' => $mo, 'hiddenField' => true));
		echo 'Di: '.$this->Form->checkbox('tu', array('value' => 2, 'checked' => $tu, 'hiddenField' => true));
		echo 'Mi: '.$this->Form->checkbox('we', array('value' => 4, 'checked' => $we, 'hiddenField' => true));
		echo 'Do: '.$this->Form->checkbox('th', array('value' => 8, 'checked' => $th, 'hiddenField' => true));
		echo 'Fr: '.$this->Form->checkbox('fr', array('value' => 16, 'checked' => $fr, 'hiddenField' => true));
		echo 'Sa: '.$this->Form->checkbox('sa', array('value' => 32, 'checked' => $sa, 'hiddenField' => true));
		echo 'So: '.$this->Form->checkbox('su', array('value' => 64, 'checked' => $su, 'hiddenField' => true));
		echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->button(__('Save'), array('type' => 'submit'));
	echo $this->Form->end();
?>