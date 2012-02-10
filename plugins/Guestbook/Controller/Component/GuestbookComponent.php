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
* @description get Guestbook Posts to display
*/
class GuestbookComponent extends Component {

	public $name = 'GuestbookComponent';
	public $components = array('Paginator', 'Guestbook.GuestbookContentValues');

	public function getData($controller, $params, $url_exts, $contentId){
		
		$data = array();
		if ($url_exts != NULL)
		foreach($url_exts as $url_part){
			$url_part == 'writePost';
			$data['writePost'] = "true";
			return $data;
		}
		
		// load the used model in order to receive data
		$controller->loadModel('Guestbook.GuestbookPost');
		
		// get desired number of posts per page
		$posts_per_page = $this->GuestbookContentValues->getValue($contentId, 'posts_per_page');
		$this->Paginator->settings = array(
		 			'limit' => $posts_per_page,
		);
		
		//get released posts
		//unfortunately query for NOT seems to be not working if NULL is used...
		return $controller->paginate('GuestbookPost', array('contentId' => $contentId, 
															'released NOT' => '0000-00-00 00:00:00', 
															'deleted' => '0000-00-00 00:00:00'));		
	}
	
	function _getPluginId($controller){
		$controller->loadModel('Plugin');
		$plugin = $controller->Plugin->findByName('Guestbook');
		return $plugin['Plugin']['id'];
	}
}