<?php
	$user = $this->Session->read('Auth.User'); // get data for current user
	$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
	$this->Html->script('/newsletter/js/newsletter', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
?>
<div id="subscription">
	<?php
		if (!($user)){	
			echo $this->Form->create('Subscription',array(
				'url' => array(
					'plugin' => 'Newsletter',
					'controller' => 'Subscription',
					'action' => 'guestUnSubscribe')));
			echo $this->Form->input('NewsletterRecipient.email', array('label' => 'E-Mail:'));
			echo $this->Html->div('validation_error',$validationErrors['email'][0]);
    		echo $this->Form->end('(Un)subscribe');
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
			if ((isset($userAsRecipient)) and ($userAsRecipient['NewsletterRecipient']['active'] == 1)){
				echo 'You subscribed for the newsletter';
				echo $this->Form->end('Unsubscribe');
			} else {
				echo 'You didn\'t subscribe for the newsletter';
				echo $this->Form->end('Subscribe');
				
			};
			echo $this->Session->flash('NewsletterRecipient');
      	};
	?>
</div>
