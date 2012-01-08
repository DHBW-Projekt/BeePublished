<?php

class SubscriptionComponent extends Component {
	
	
	public function getData($controller, $params, $url)
	{
		$controller->loadModel('NewsletterRecipient');
		$recipients = $controller->NewsletterRecipient->find('all');
		$user = $controller->Auth->user();
		$userAsRecipient = $controller->NewsletterRecipient->find('first',
			array('conditions' => array(
				'NewsletterRecipient.email' => $user['email'],
				'active' => 1)
			)
		);
		$userAsRecipient = $userAsRecipient['NewsletterRecipient'];
		if ($userAsRecipient && !($userAsRecipient['user_id']) && ($user['id'])){
			$userAsRecipient['user_id'] = $user['id'];
			$controller->NewsletterRecipient->set($userAsRecipient);
			$controller->NewsletterRecipient->save();
		};
		$data = array('NewsletterRecipient' => $recipients,
					'userAsRecipient' => $userAsRecipient);
		if ($data != null) 
			return $data;
		else 
			return __('no entries');
	}

	
	
}