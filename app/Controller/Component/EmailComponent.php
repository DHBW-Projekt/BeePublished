<?php
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component{
	
	public function sendHtmlEmail($to = null, $subject = null, $viewVars = null, $viewName = null){
		//get active config with email layout and email from
		$emailLayout;
		if($emailLayout == null || $emailLayout == ''){
			$emailLayout = 'email';
		}
		$emailFrom;
		if($emailFrom == null || $emailFrom == ''){
			$emailFrom = "noreplay@".env('SERVER_NAME');
		}
		
		$email = new CakeEmail();
		$email->template($viewName, $emailLayout);
		$email->emailFormat('html');
		$email->to($to);
		$email->from($emailFrom);
		$email->subject($subject);
		$email->viewVars($viewVars);
		$email->send();
	}
	
	public function sendTextEmail($to = null, $subject = null, $text = null){
		$emailFrom;
		if($emailFrom == null || $emailFrom == ''){
			$emailFrom = "noreplay@".env('SERVER_NAME');
		}
		
		$email = new CakeEmail();
		$email->emailFormat('text');
		$email->to($to);
		$email->from($emailFrom);
		$email->subject($subject);
		$email->send($text);
	}
}