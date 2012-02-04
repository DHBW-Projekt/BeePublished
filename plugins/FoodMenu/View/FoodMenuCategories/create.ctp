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
 * @description View for category creation
 */
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
	echo $this->Session->flash();
	
	echo '<h1>'.__d('food_menu', 'Create category').'</h1>';
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	//check permission of current user
	if($createAllowed){
		echo $this->Form->input('name', array('label' => (__d('food_menu', 'name:'))));
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>