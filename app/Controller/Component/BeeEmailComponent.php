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
 * @description Manage Emailing for BeePublished
 */

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
		try{
			$email->send();
		}catch (Exception $e){
			
		}
		
	}
	
	function prepareContent($checkString) {
    	$pattern = "/src=\"\/uploads\//";
		$replacement = "src=\"http://".env('SERVER_NAME')."/uploads/";
		$string = preg_replace($pattern, $replacement, $checkString);
		return $string;
    }
}
