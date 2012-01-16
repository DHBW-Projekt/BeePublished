<?php

class NewsblogOverviewComponent extends Component {

	public function getData($controller, $params, $url, $id){
		$controller->loadModel('Newsblog.NewsEntry');
		$controller->loadModel('Newsblog.NewsblogTitle');

		$now = date('Y-m-d H:i:s');
		$conditionsNE = array("NewsEntry.deleted !=" => true, "NewsEntry.content_id" => $id, "NewsEntry.published" => true, "NewsEntry.validFrom <" => $now, "NewsEntry.validTo >" => $now);
		$optionsNE['conditions'] = $conditionsNE;
		$optionsNE['order'] = array('createdOn DESC');

		$conditionsNT = array("NewsblogTitle.content_id" => $id);
		$optionsNT['conditions'] = $conditionsNT;

		$data['publishedNewsEntries'] = $controller->NewsEntry->find('all',$optionsNE);
		$data['newsblogTitle'] = $controller->NewsblogTitle->find('first', $optionsNT);
		$data['view'] = 'NewsblogOverview';
		$data['contentId'] = $id;
		return $data;
	}
}