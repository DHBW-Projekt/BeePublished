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
			// check if user has subscribed while not registred or logged in and add user_id  in case
			if ($userAsRecipient && !($userAsRecipient['NewsletterRecipient']['user_id']) && ($user['id'])){
				$userAsRecipient['NewsletterRecipient']['user_id'] = $user['id'];
				$controller->NewsletterRecipient->set($userAsRecipient);
				$controller->NewsletterRecipient->save();
			};
			// check if user changed emailaddress
			if($user['email'] != $userAsRecipient['NewsletterRecipient']['email']){
				echo '2';
				$userAsRecipient['NewsletterRecipient']['email'] = $user['email'];
				$controller->NewsletterRecipient->set($userAsRecipient);
				$controller->NewsletterRecipient->save();
			}
		};
		$data = array('NewsletterRecipient' => $recipients,
					'userAsRecipient' => $userAsRecipient);
		if ($data != null)
		return $data;
		else
		return __('no entries');
	}
}