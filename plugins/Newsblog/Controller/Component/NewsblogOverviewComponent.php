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
* @description Component to get the data of all valid news entries of a certain newsblog
*/

class NewsblogOverviewComponent extends Component {
	var $components = array('ContentValueManager');
	public function getData($controller, $params, $url, $id){
		$controller->loadModel('Newsblog.NewsEntry');
		
		$now = date('Y-m-d H:i:s');
		$conditionsNE = array("NewsEntry.deleted !=" => true, "NewsEntry.content_id" => $id, "NewsEntry.published" => true, "NewsEntry.validFrom <" => $now, "NewsEntry.validTo >" => $now);
		$optionsNE['conditions'] = $conditionsNE;
		$optionsNE['order'] = array('createdOn DESC');
		
		$contentValues = $this->ContentValueManager->getContentValues($id);
		if (array_key_exists('newsblogtitle', $contentValues)) {
			$newsblogtitle = $contentValues['newsblogtitle'];
		} else {
			$newsblogtitle = null;
		}
		
		$data['publishedNewsEntries'] = $controller->NewsEntry->find('all',$optionsNE);
		$data['newsblogTitle'] = $newsblogtitle;
		$data['view'] = 'NewsblogOverview';
		$data['contentId'] = $id;
		return $data;
	}
}