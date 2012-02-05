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
 * @description App Controller for FoodMenu plugin
 */
class FoodMenuAppController extends AppController {
	
	var $helpers = array('Number');
	public $uses = array('Plugin');
	
	//return id of the FoodMenu-Plugin
	protected function getPluginId(){
		$foodMenuPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $foodMenuPlugin['Plugin']['id'];
		return $pluginId;
	}

}