<?php

class NewsblogOverviewComponent extends Component {

	public function getData($controller, $params, $url, $id){
		$controller->loadModel('Newsblog.NewsEntry');
		
		$now = date('Y-m-d H:i:s');
		$conditionsNE = array("NewsEntry.deleted !=" => true, "NewsEntry.content_id" => $id, "NewsEntry.published" => true, "NewsEntry.validFrom <" => $now, "NewsEntry.validTo >" => $now);
		
		$optionsNE['conditions'] = $conditionsNE;
		$optionsNE['order'] = array('createdOn DESC');
		
		$data['publishedNewsEntries'] = $controller->NewsEntry->find('all',$optionsNE);
		$data['view'] = 'NewsblogOverview';
		return $data;
	}
}