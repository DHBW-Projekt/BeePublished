<?php

class ShowNewsComponent extends Component {
	var $components = array('Newsblog.NewsblogOverview','Newsblog.NewsblogDetail');
	public function getData($controller, $params, $url, $id){
		if (sizeof($url) > 0){
			return $this->NewsblogDetail->getData($controller, $params, $url, $id);
		} else{
			return $this->NewsblogOverview->getData($controller, $params, $url, $id);
		}
	}
}