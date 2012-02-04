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
 * @description View for creating associations between menus and categories
 */
	echo $this->element('admin_menu');
	$this->Html->script('jquery/jquery.sortable', false);
	$this->Html->script('/food_menu/js/sortable_menu_categories', false);
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuMenusFoodMenuCategories');
	echo $this->Form->hidden('menuID', array('value' => $menuID));
	echo $this->Session->flash();
	
	//check permission of current user
	if($editAllowed) { ?>	
	<div id="sortablelists">
	<h2><?php echo __d('food_menu', 'Drop categories on the left to add them to the menu'); ?></h2>
	<ul id="sortable1" class="connectedSortable">
	<?php
	if (sizeof($categories['used']) > 0) {
		foreach ($categories['used'] as $usedCategory) {
			echo '<li rel="' . $menuID . '" id="' . $usedCategory['FoodMenuCategory']['id'] .'">' . $usedCategory['FoodMenuCategory']['name'] . '</li>';
		} 
	}?>
	</ul>
 	<ul id="sortable2" class="connectedSortable">
	<?php 
 	if (sizeof($categories['notUsed']) > 0) {
		foreach ($categories['notUsed'] as $notUsedCategory) {
			echo '<li rel="' . $menuID . '" id="' . $notUsedCategory['FoodMenuCategory']['id'] .'">' . $notUsedCategory['FoodMenuCategory']['name'] . '</li>';
		} 
 	}?>

	</ul>
 	</div>
 	<?php 
	echo $this->Form->end();
	}//end if($editAllowed)
?>