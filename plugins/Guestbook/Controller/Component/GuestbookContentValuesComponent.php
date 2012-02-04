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
* @author Sebastian Haase
*
* @description Component to get and set default values / configurations for plugin
*/
class GuestbookContentValuesComponent extends Component {
	
	public $components = array('ContentValueManager');
	
	public $defaults = array(
		'posts_per_page' => '10',
		'send_emails' => 'yes',
		'delete_immediately' => 'no'
		);
	
	function getValue($contentId, $key){
		$contentValues = $this->ContentValueManager->getContentValues($contentId);
		if (array_key_exists($key, $contentValues)){
			return $contentValues[$key];
		} elseif (array_key_exists($key, $this->defaults)){
			return $this->defaults[$key];
		}
		throw InternalErrorException('GuestbookContentValuesComponent -> key not found');
	}
	
}