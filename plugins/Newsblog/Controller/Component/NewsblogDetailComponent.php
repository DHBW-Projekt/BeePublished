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
* @author Philipp Scholl
*
* @description Componente to read the data of a specific news entry
*/

class NewsblogDetailComponent extends Component {

	public function getData($controller, $params, $url, $id){
		$urlParts = explode('-', $url[0], 2);
		$newsEntryId = $urlParts[0];
		
		//load current data of newsentry with id = $newsEntryId
		$controller->loadModel('Newsblog.NewsEntry');
		$controller->loadModel('User');
		
		$newsEntry = $controller->NewsEntry->findById($newsEntryId);
		
		$socialNetworks['facebook'] = $this->Config->getValue('facebook');
		$socialNetworks['twitter'] = $this->Config->getValue('twitter');
		$socialNetworks['googleplus'] = $this->Config->getValue('googleplus');
		$socialNetworks['xing'] = $this->Config->getValue('xing');
		$socialNetworks['linkedin'] = $this->Config->getValue('linkedin');
		
		$data['socialNetworks'] = $socialNetworks;
		$data['NewsEntry'] = $newsEntry['NewsEntry'];
		$data['Author'] = $newsEntry['Author']['username'];
		$data['view'] = 'NewsblogDetail';
		return $data;
	}
}