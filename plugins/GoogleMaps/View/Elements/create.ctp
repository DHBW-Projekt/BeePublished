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
* @author Patrick Zamzow
*
* @description Google Maps admin create view
*/

	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<h1><?php echo __d("google_maps", "Create new location"); ?></h1>

<?php 
	echo $this->Form->create('GoogleMapsLocation', array('url' => array('controller' => 'Location', 'action' => 'create', $contentID)));
	echo $this->Form->input('street', array('label' => (__d("google_maps", 'Street').':')));
	echo $this->Form->input('street_number', array('label' => (__d("google_maps", 'Street Number').':')));
	echo $this->Form->input('zip_code', array('label' => (__d("google_maps", 'ZIP Code').':')));
	echo $this->Form->input('city', array('label' => (__d("google_maps", 'City').':')));
	echo $this->Form->input('country', array('label' => (__d("google_maps", 'Country').':')));
	echo $this->Form->submit(__d('web_shop', 'Save', true), array('name' => 'save', 'div' => false));
	echo $this->Form->submit(__d('web_shop', 'Cancel', true), array('name' => 'cancel', 'div' => false));
	echo $this->Form->end();
?>