<?php
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Session->flash();
	if($editAllowed){
		echo $this->Form->create('FoodMenuAddCategories', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenusFoodMenuCategories', 'action' => 'index', $menu['FoodMenuMenu']['name'], $menu['FoodMenuMenu']['id'])));
		echo '<h1>'.(__d('food_menu', 'Add categories to menu')).'</h1>';
		echo $this->Form->end(__d('food_menu', 'Add categories'));
		echo '<br /><hr /><br />';
		echo '<h1>'.(__d('food_menu', 'Edit Menu')).'</h1>';
		echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'edit')), array('class' => 'edit'));
		echo $this->Form->hidden('id', array('value' => $menu['FoodMenuMenu']['id']));
		echo $this->Form->input('name', array('value' => $menu['FoodMenuMenu']['name'], 'label' => (__d('food_menu', 'Name:'))));
		echo $this->Form->input('valid_from', array('value' => $menu['FoodMenuMenu']['valid_from'], 'selected'=>$menu['FoodMenuMenu']['valid_from'], 'label' => (__d('food_menu', 'Valid From:'))));
		echo $this->Form->input('valid_until', array('value' => $menu['FoodMenuMenu']['valid_until'], 'selected'=>$menu['FoodMenuMenu']['valid_until'], 'label' => (__d('food_menu', 'Valid until:'))));
			echo $this->Form->label(__d('food_menu', 'Valid on weekday:'));
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
			
			echo __d('food_menu', 'Mon:').' '.$this->Form->checkbox('mo', array('class' => 'adminCheckbox', 'value' => 1, 'checked' => $mo, 'hiddenField' => true));
			echo __d('food_menu', 'Tue:').' '.$this->Form->checkbox('tu', array('class' => 'adminCheckbox', 'value' => 2, 'checked' => $tu, 'hiddenField' => true));
			echo __d('food_menu', 'Wed:').' '.$this->Form->checkbox('we', array('class' => 'adminCheckbox', 'value' => 4, 'checked' => $we, 'hiddenField' => true));
			echo __d('food_menu', 'Thu:').' '.$this->Form->checkbox('th', array('class' => 'adminCheckbox', 'value' => 8, 'checked' => $th, 'hiddenField' => true));
			echo __d('food_menu', 'Fri:').' '.$this->Form->checkbox('fr', array('class' => 'adminCheckbox', 'value' => 16, 'checked' => $fr, 'hiddenField' => true));
			echo __d('food_menu', 'Sat:').' '.$this->Form->checkbox('sa', array('class' => 'adminCheckbox', 'value' => 32, 'checked' => $sa, 'hiddenField' => true));
			echo __d('food_menu', 'Sun:').' '.$this->Form->checkbox('su', array('class' => 'adminCheckbox', 'value' => 64, 'checked' => $su, 'hiddenField' => true));
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>