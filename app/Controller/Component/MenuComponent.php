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
 * @author Christoph Krämer
 *
 * @description Build menu array structure
 */

class MenuComponent extends Component
{	
	var $components = array('PermissionValidation');
	
    function buildMenu($controller,$parent_id = null) {
    	$userRoleID = $this->PermissionValidation->getUserRoleId();
    	$entries = $controller->MenuEntry->find('all', array(
        	'conditions' => array(
    				'MenuEntry.parent_id' => $parent_id,
        			'MenuEntry.role_id <=' => $userRoleID
        	),
    		'order' => array('MenuEntry.order ASC'),
    	));
        $output = array();
        foreach($entries as $entry) {
            $page = $entry['Page'];
            $entry = $entry['MenuEntry'];
            //recursive call for submenu
            $entry['Children'] = $this->buildMenu($controller,$entry['id']);
            $entry['Page'] = $page;
            $output[] = $entry;
        }
        return $output;
    }
}