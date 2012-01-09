<?php

class SubscriptionComponent extends Component {
	
	
	public function getData($controller, $params, $url)
	{
		$controller->loadModel('NewsletterRecipient');
		$recipients = $controller->NewsletterRecipient->find('all');
		$user = $controller->Auth->user();
		$conditions = array( 'OR' => array('NewsletterRecipient.user_id' => $user['id'], 'NewsletterRecipient.email' => $user['email']));
		$userAsRecipient = $controller->NewsletterRecipient->find('first', array(
			'conditions' => $conditions));
		if (isset($userAsRecipient)){
			$userAsRecipient = $userAsRecipient['NewsletterRecipient'];
		
			if ($userAsRecipient && !($userAsRecipient['user_id']) && ($user['id'])){
				$userAsRecipient['user_id'] = $user['id'];
				$userAsRecipient['email'] = NULL;
				$controller->NewsletterRecipient->set($userAsRecipient);
				$controller->NewsletterRecipient->save();
			};
		};
		$data = array('NewsletterRecipient' => $recipients,
					'userAsRecipient' => $userAsRecipient);
		if ($data != null) 
			return $data;
		else 
			return __('no entries');
	}
}