<?php
App::uses('CakeEmail', 'Network/Email');

class BeeEmailComponent extends Component{
	
	public function sendHtmlEmail($to = null, $subject = null, $viewVars = array(), $viewName = null){		
		$emailLayout = 'email';
		
		$emailFrom = "noreply@".env('SERVER_NAME');
		if(env('SERVER_NAME') == 'localhost'){
			$emailFrom = $emailFrom.'.de';
		}
		
		if (!is_array($viewVars)) {
			$preparedText = $this->prepareContent($viewVars);
			$viewVars = array("emailContent" => $preparedText);
		}
		
		$this->EmailTemplate = ClassRegistry::init('EmailTemplate');
		$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.active' => '1')));
		if ($selectedTemplate) {
			list ($header, $footer) = explode("EMAILTEXTCONTENT", $selectedTemplate['EmailTemplate']['content'], 2);
			$viewVars = array_merge(array('header' => $header, 'footer' => $footer), $viewVars);
		}		
		
		if ($viewName == null) 
			$viewName = 'beepublished'; 
		
		$email = new CakeEmail();
		$email->template($viewName, $emailLayout);
		$email->emailFormat('html');
		$email->to($to);
		$email->from($emailFrom);
		$email->subject($subject);
		$email->viewVars($viewVars);
		$email->transport('Mail');
		$email->send();
	}
	
	function prepareContent($checkString) {
    	$pattern = "/src=\"\/uploads\//";
		$replacement = "src=\"http://".env('SERVER_NAME')."/uploads/";
		$string = preg_replace($pattern, $replacement, $checkString);
		return $string;
    }
}
