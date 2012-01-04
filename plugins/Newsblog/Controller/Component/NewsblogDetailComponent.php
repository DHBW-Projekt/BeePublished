<?php

class NewsblogDetailComponent extends Component {

	public function getData($controller, $params, $url, $id){
		$urlParts = explode('-', $url[0], 2);
		$newsEntryId = $urlParts[0];
		
		//load current data of newsentry with id = $newsEntryId
		$controller->loadModel('Newsblog.NewsEntry');
		$controller->loadModel('User');
			
		$controller->NewsEntry->bindModel(
			array('belongsTo' => array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => 'author_id'
				)
			))
		);
		$newsEntry = $controller->NewsEntry->findById($newsEntryId);
		
		$data['NewsEntry'] = $newsEntry['NewsEntry'];
		$data['Author'] = $newsEntry['User']['username'];
		$data['view'] = 'NewsblogDetail';
		return $data;
	}
}