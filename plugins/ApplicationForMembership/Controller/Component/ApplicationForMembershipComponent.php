<?php
App::uses('Sanitize', 'Utility');
class ApplicationForMembershipComponent extends Component {

	
	public function getData($controller, $params, $url){
		
		
		//$func_data = $this->send($controller);
		
		//CHECK url
		if (isset($url)){
			$data['Element'] = array_shift($url);
			$func_params = $url;
		} else {
			$data['Element'] = 'send';
			$func_params = null;
		}
		
		//CALL corresponding comp. method
		if (method_exists($this, $data['Element'])){
			$func_data = $this->{$data['Element']}($controller, $func_params);
			
			if (isset($func_data['data'])) {
				$data['data'] = $func_data['data'];
			}
			if (isset($func_data['Element'])) {
				$data['Element'] = $func_data['Element'];
			}
		}
		
		//RETURN data
		if ($data != null) {
			if (!isset($data['data'])) { $data['data'] = null; }
			if (!isset($data['Element'])) { $data['Element'] = null; }
			
			return $data;
		} else {
			return __('no data');
		}
	}
}