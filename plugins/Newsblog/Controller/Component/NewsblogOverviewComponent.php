<?php

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