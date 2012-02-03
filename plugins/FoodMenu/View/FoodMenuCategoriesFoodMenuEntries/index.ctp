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
 * @description View for creating associations between categories and entries
 */
	echo $this->element('admin_menu');
	$this->Html->script('jquery/jquery.sortable', false);
	$this->Html->script('/food_menu/js/sortable_category_entries', false);
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	echo $this->Form->create('FoodMenuCategoriesFoodMenuEntries');
	echo $this->Form->hidden('categoryID', array('value' => $categoryID));
	echo $this->Session->flash();
	
	//check permission of current user
	if($editAllowed) {	
	?>
	
	<div id="sortablelists">
	<h2><?php echo __d('food_menu', 'Drop entries on the left to add them to the category');
	
	//jQuery sortable lists
	
	?></h2>
	<ul id="sortable1" class="connectedSortable">
	<?php
	if (sizeof($entries['used']) > 0) {
		foreach ($entries['used'] as $usedEntry) {
			echo '<li id="' . $usedEntry['FoodMenuEntry']['id'] .'">' . $usedEntry['FoodMenuEntry']['name'] . '</li>';
		} 
	}?>
	</ul>
 	<ul id="sortable2" class="connectedSortable">
	<?php 
 	if (sizeof($entries['notUsed']) > 0) {
		foreach ($entries['notUsed'] as $notUsedEntry) {
			echo '<li id="' . $notUsedEntry['FoodMenuEntry']['id'] .'">' . $notUsedEntry['FoodMenuEntry']['name'] . '</li>';
		} 
 	}?>
	</ul>
 	</div>
 	<?php 
	echo $this->Form->end();
	}// end if($editAllowed)
?>