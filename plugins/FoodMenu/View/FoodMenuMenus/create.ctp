<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Benedikt Steffan
 * 
 * @description View for creating menus
 */
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	//check permission of current user
	if($createAllowed) {
		echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'create')));
		echo $this->Session->flash();
		
		echo '<h1>'.__d('food_menu', 'Create menu').'</h1>';
			echo $this->Form->input('name', array('label' => (__d('food_menu', 'Name:')))).'<br />';
			echo $this->Form->input('valid_from', array('label' => (__d('food_menu', 'Valid from:')))).'<br />';
			echo $this->Form->input('valid_until', array('label' => (__d('food_menu', 'Valid until:')))).'<br />';
		echo $this->Form->label(__d('food_menu', 'Valid on weekday:'));
			echo __d('food_menu', 'Mon:').' '.$this->Form->checkbox('mo', array('class' => 'adminCheckbox', 'value' => 1, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Tue:').' '.$this->Form->checkbox('tu', array('class' => 'adminCheckbox', 'value' => 2, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Wed:').' '.$this->Form->checkbox('we', array('class' => 'adminCheckbox', 'value' => 4, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Thu:').' '.$this->Form->checkbox('th', array('class' => 'adminCheckbox', 'value' => 8, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Fri:').' '.$this->Form->checkbox('fr', array('class' => 'adminCheckbox', 'value' => 16, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Sat:').' '.$this->Form->checkbox('sa', array('class' => 'adminCheckbox', 'value' => 32, 'checked' => true, 'hiddenField' => true));
			echo __d('food_menu', 'Sun:').' '.$this->Form->checkbox('su', array('class' => 'adminCheckbox', 'value' => 64, 'checked' => true, 'hiddenField' => true));
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>
