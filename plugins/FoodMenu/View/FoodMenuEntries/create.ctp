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
 * @description View for creating entries
 */
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	//check permission of current user
	if($createAllowed) {
		echo '<h1>'.__d('food_menu', 'Create entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create')));
		echo $this->Form->input('name', array('label' => (__d('food_menu', 'Name:')))).'<br />';
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'label' => (__d('food_menu', 'Description:')))).'<br />';
		echo $this->Form->input('price', array('label' => (__d('food_menu', 'Price:')))).'<br />';
		
		//add more currencies here and in model validation of FoodMenuEntryModel
		// would be more flexible if you create a database table for allowed currencies
		$options = array(
					'EUR' => __d('food_menu', 'Euro'), 
					'USD' => __d('food_menu', 'US Dollar'), 
					'CAD' => __d('food_menu', 'Canadian Dollar'), 
					'GBP' => __d('food_menu', 'Great Britain Pound'), 
					'CHF' => __d('food_menu', 'Swiss Frank')
					);
		echo $this->Form->label(__d('food_menu', 'Currency:'));
		echo $this->Form->select('currency', $options) . '<br />';
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>