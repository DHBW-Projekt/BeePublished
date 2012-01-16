<?php
App::uses('CakeEmail', 'Network/Email');

class BeeEmailComponent extends Component{
	
	public function sendHtmlEmail($to = null, $subject = null, $viewVars = null, $viewName = null){
		//get active config with email layout and email from
		$emailLayout = null;
		if($emailLayout == null || $emailLayout == ''){
			$emailLayout = 'email';
		}
		$emailFrom = null;
		if($emailFrom == null || $emailFrom == ''){
			$emailFrom = "noreply@".env('SERVER_NAME');
			if(env('SERVER_NAME') == 'localhost'){
				$emailFrom = $emailFrom.'.de';
			}
		}
		
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
	
	public function sendTextEmail($to = null, $subject = null, $text = null){
		$emailFrom;
		if($emailFrom == null || $emailFrom == ''){
			$emailFrom = "noreplay@".env('SERVER_NAME');
			if(env('SERVER_NAME') == 'localhost'){
				$emailFrom = $emailFrom.'.de';
			}
		}
		
		$email = new CakeEmail();
		$email->emailFormat('text');
		$email->to($to);
		$email->from($emailFrom);
		$email->subject($subject);
		$email->send($text);
	}
}