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
 * @description View for editing entries
 */
	echo $this->element('admin_menu');
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	//check permission of current user
	if($editAllowed){
		echo '<h1>'.__d('food_menu', 'Edit entry').'</h1>';
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit')));
		echo $this->Form->hidden('id', array('value' => $entry['FoodMenuEntry']['id']));
		echo $this->Form->input('name', array('value' => $entry['FoodMenuEntry']['name'], 'label' => (__d('food_menu', 'Name:'))));
		echo $this->Form->input('description', array('div' => 'mandatory', 'type' => 'textarea', 'value' => $entry['FoodMenuEntry']['description'], 'label' => (__d('food_menu', 'Description:'))));
		echo $this->Form->input('price', array('value' => $entry['FoodMenuEntry']['price'], 'label' => (__d('food_menu', 'Price:'))));
		$options = array(
					'EUR' => __d('food_menu', 'Euro'), 
					'USD' => __d('food_menu', 'US Dollar'), 
					'CAD' => __d('food_menu', 'Canadian Dollar'), 
					'GBP' => __d('food_menu', 'Great Britain Pound'), 
					'CHF' => __d('food_menu', 'Swiss Frank')
					);
		echo $this->Form->label(__d('food_menu', 'Currency:'));
		echo $this->Form->select('currency', $options, array('default' => $entry['FoodMenuEntry']['currency'])) . '<br />';
		echo $this->Form->end(__d('food_menu', 'Save'));
	}
?>