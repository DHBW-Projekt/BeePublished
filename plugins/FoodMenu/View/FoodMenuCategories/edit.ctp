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
 * @description View for editing categories
 */
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Session->flash();
	echo $this->Form->create('FoodMenuAddEntries', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategoriesFoodMenuEntries', 'action' => 'index', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	
	//check permission of current user
	if($editAllowed){
		echo '<h1>'.(__d('food_menu', 'Add Entries to category')).'</h1>';
		echo $this->Form->end(__d('food_menu', 'Add entries'));
		echo '<br /><hr /><br />';
		echo '<h1>'.(__d('food_menu', 'Edit Category')).'</h1>';
		echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'edit')));
		echo $this->Form->hidden('id', array('value' => $category['FoodMenuCategory']['id']));
		echo $this->Form->input('name', array('value' => $category['FoodMenuCategory']['name'], 'label' => (__d('food_menu', 'Name:'))));
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>