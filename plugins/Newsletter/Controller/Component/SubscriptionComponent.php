<?php

class SubscriptionComponent extends Component {
	
	public function getData($controller, $params, $url)
	{
		$controller->loadModel('NewsletterRecipient');
		$recipients = $controller->NewsletterRecipient->find('all');
		$data = array('NewsletterRecipient' => $recipients);
//		debug($data, $showHtml=null, $showFrom=true);
		if ($data != null) 
			return $data;
		else 
			return __('no entries');
	}
	
}