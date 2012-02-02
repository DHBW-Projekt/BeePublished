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
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

/**
 * 
 * NewsletterAppController
 * @author marcuslieberenz
 *
 */
class NewsletterAppController extends AppController {
	public $uses = array('Plugin');
	
	public function getPluginId(){
		$newsletterPlugin = $this->Plugin->findByName($this->plugin);
		$pluginId = $newsletterPlugin['Plugin']['id'];
		return $pluginId;
	}
	
/**
     * beforeFilter function
     *
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('unSubscribePerMail');
    }
}

