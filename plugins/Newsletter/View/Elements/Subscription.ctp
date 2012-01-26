<?php

$user = $this->Session->read('Auth.User'); // get data for current user
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
$this->Html->script('/newsletter/js/newsletter', false);
$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

$allowedActions = $this->PermissionValidation->getPermissions($pluginId);

echo '<div id="subscription">';
	echo '<h1>'.__d('newsletter','Newsletter').'</h1>';
	echo $data['text'];
	echo '<br><br>';
	if (!($user)){	
		echo '<div class = "subscription_form">';
		echo $this->Form->create('Subscription',array(
			'url' => array(
				'plugin' => 'Newsletter',
				'controller' => 'Subscription',
				'action' => 'guestUnSubscribe')));
		echo $this->Form->input('NewsletterRecipient.email', array('label' => __d('newsletter','E-Mail:')));
		echo $this->Html->div('validation_error',$validationErrors['email'][0]);
   		echo $this->Form->end(__d('newsletter','(Un)subscribe'));
//    		echo '</div>';
//    		echo '</div>';
   		echo $this->Session->flash('NewsletterRecipient');
    } 
	// 	if current user is registered
    else if ($user) {
		// check for newsletter subscription
    	$userAsRecipient = $data['userAsRecipient'];
    	echo $this->Form->create('UserSubscription', array(
    		'url' => array(
    			'plugin' => 'Newsletter',
    			'controller' => 'Subscription',
    			'action' => 'userUnSubscribe')));
		if (isset($userAsRecipient)){
			if ((isset($userAsRecipient['NewsletterRecipient']['active'])) && ($userAsRecipient['NewsletterRecipient']['active'] == 1)){
				echo __d('newsletter','You subscribed for the newsletter');
				echo $this->Form->end(__d('newsletter','Unsubscribe'));
			} else {
				echo __d('newsletter','You didn\'t subscribe for the newsletter');
				echo $this->Form->end(__d('newsletter','Subscribe'));
			};
		};
		echo $this->Session->flash('NewsletterRecipient');
	};
echo '</div>';

if($this->PermissionValidation->getUserRole() < 6 
	&& ($allowedActions['CreateNewsletter'] 
	|| $allowedActions['EditNewsletter']
	|| $allowedActions['SendNewsletter'])){
    echo '<div class="plugin_administration">';
        echo $this->Html->link($this->Html->image('tools_small.png'),array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'admin', $data['contentId']), array('escape' => false));
    echo '</div>';
}

