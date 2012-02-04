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
 * @description View for menu in admin-Overlay
 */
	$this->Html->css('menu-design', NULL, array('inline' => false));
	$this->Html->css('menu-template', NULL, array('inline' => false));
	$this->Html->css('/food_menu/css/menu', NULL, array('inline' => false));

	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
?>
<div id="menu" class="overlay"> 

    <ol class="nav"> 

		<li><?php echo $this->Html->link((__d('food_menu', 'Menus')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__d('food_menu', 'Categories')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__d('food_menu', 'Entries')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'index')); ?></li>
	

    </ol> 

    <div style="clear:both;"></div> 

</div>