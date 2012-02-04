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
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Christoph Kr‰mer
*
* @description Basic Settings for all controllers
*/

/**
 * 
 * Component for Subscription element.
 * @author marcuslieberenz
 *
 */
class SubscriptionComponent extends Component {
	
	/**
	 * 
	 * Set data for view.
	 */
	public function getData($controller, $params, $url, $contentID)
	{
		// load recipients
		$controller->loadModel('NewsletterRecipient');
		$recipients = $controller->NewsletterRecipient->find('all');
		// load user data		
		$user = $controller->Auth->user();
		// check if user is already a recipient
		$conditions = array( 'OR' => array(
			'NewsletterRecipient.user_id' => $user['id'],
			'NewsletterRecipient.email' => $user['email']));
		$userAsRecipient = $controller->NewsletterRecipient->find('first', array(
			'conditions' => $conditions));
		if (isset($userAsRecipient)){
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
		// load content values
		if (!array_key_exists('text',$params)) {
			$text = __d('newsletter','Here you can subscribe to or unsubscribe from our newsletter.');
		} else {
			$text = $params['text']; //exists and published
		}
		// fill data array and return
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