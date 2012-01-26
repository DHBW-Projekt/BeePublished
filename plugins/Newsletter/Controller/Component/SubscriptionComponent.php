<?php

class SubscriptionComponent extends Component {
	
	public function getData($controller, $params, $url, $contentID)
	{
		$controller->loadModel('NewsletterRecipient');
		$recipients = $controller->NewsletterRecipient->find('all');
		$user = $controller->Auth->user();
		$conditions = array( 'OR' => array(
			'NewsletterRecipient.user_id' => $user['id'],
			'NewsletterRecipient.email' => $user['email']));
		$userAsRecipient = $controller->NewsletterRecipient->find('first', array(
			'conditions' => $conditions));
		if (isset($userAsRecipient)){
			// check if user is already a recipient
			if ($userAsRecipient && !($userAsRecipient['NewsletterRecipient']['user_id']) && ($user['id'])){
				$userAsRecipient['NewsletterRecipient']['user_id'] = $user['id'];
				$controller->NewsletterRecipient->set($userAsRecipient);
				$controller->NewsletterRecipient->save();
			};
			// check if user changed emailaddress
			if((isset($user)) && ($user['email'] != $userAsRecipient['NewsletterRecipient']['email'])){
				$userAsRecipient['NewsletterRecipient']['email'] = $user['email'];
				$controller->NewsletterRecipient->set($userAsRecipient);
				$controller->NewsletterRecipient->save();
			}
		};
		if (!array_key_exists('text',$params)) {
			$text = __d('newsletter','no text');
		} else {
			$text = $params['text']; //exists and published
		}
		
		$data = array(
			'text' => $text,
			'contentId' => $contentID,
			'NewsletterRecipient' => $recipients,
			'userAsRecipient' => $userAsRecipient);
		if ($data != null) 
			return $data;
		else 
			return __d('newsletter','no entries');
	}
}