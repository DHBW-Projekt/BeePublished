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
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

$user = $this->Session->read('Auth.User'); // get data for current user
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
$this->Html->script('/newsletter/js/newsletter', false);
$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

// get actions that are allowed for current user
$allowedActions = $this->PermissionValidation->getPermissions($pluginId);

echo '<div id="subscription">';
	// title
	echo '<h1>'.__d('newsletter','Newsletter').'</h1>';
	// echo text that is saved in content values
	if (($data['text'] != ' ') || ($data['text'] != '') || !($data['text'] == null) || !(isset($data['text']))){
		echo $data['text'];
		echo '<br><br>';
	}
	if (!($user)){	
		// show form with input field to unSubscribe
		echo '<div class="subscription_form">';
			echo $this->Form->create('Subscription',array(
				'url' => array(
					'plugin' => 'Newsletter',
					'controller' => 'Subscription',
					'action' => 'guestUnSubscribe')));
			echo $this->Form->input('NewsletterRecipient.email', array('label' => __d('newsletter','E-Mail:')));
			echo $this->Html->div('validation_error',$validationErrors['email'][0]);
   			echo $this->Form->end(__d('newsletter','(Un)subscribe'));
   			echo $this->Session->flash('NewsletterRecipient');
   		echo '</div>';
    } 
	// 	if current user is registered
    else if ($user) {
		// check for newsletter subscription
    	$userAsRecipient = $data['userAsRecipient'];
		if (isset($userAsRecipient)){
			// if user has subscribed, show unsubscribe button
			if ((isset($userAsRecipient['NewsletterRecipient']['active'])) && ($userAsRecipient['NewsletterRecipient']['active'] == 1)){
				echo __d('newsletter','You subscribed to our newsletter');
				echo $this->Form->create('UserSubscription', array(
				    		'url' => array(
				    			'plugin' => 'Newsletter',
				    			'controller' => 'Subscription',
				    			'action' => 'userUnSubscribe')));
				echo $this->Form->end(__d('newsletter','Unsubscribe'));
			} else {
				// if user hasn't subscribed, show subscribe button
				echo __d('newsletter','You didn\'t subscribe to our newsletter');
				echo $this->Form->create('UserSubscription', array(
				    		'url' => array(
				    			'plugin' => 'Newsletter',
				    			'controller' => 'Subscription',
				    			'action' => 'userUnSubscribe')));
				echo $this->Form->end(__d('newsletter','Subscribe'));
			};
		};
		echo $this->Session->flash('NewsletterRecipient');
	};
echo '</div>';

// if user is admin or is allowed to create/edit/save newsletters show button to get to admin overlay
if($this->PermissionValidation->getUserRole() < 6 
	&& ($allowedActions['CreateNewsletter'] 
	|| $allowedActions['EditNewsletter']
	|| $allowedActions['SendNewsletter'])){
    echo '<div class="plugin_administration">';
        echo $this->Html->link($this->Html->image('tools_small.png'),array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'admin', $data['contentId']), array('escape' => false));
    echo '</div>';
}

