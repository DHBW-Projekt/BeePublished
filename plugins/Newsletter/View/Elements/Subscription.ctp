<?php
$user = $this->Session->read('Auth.User'); // get data for current user
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
?>
<div id="subscription">
	<?php
		if (($user['role_id']) == '7') {
			echo $this->Form->create('Subscription',array('url' => array('plugin' => 'Newsletter',
														   		  'controller' => 'Subscription',
														   		  'action' => 'subscribe')));
			echo $this->Form->input('NewsletterRecipient.email', array('label' => 'E-Mail:'));
			echo $this->Html->div('validation_error',$validationErrors['email'][0]);
	    	echo $this->Form->end('(Un)subscribe');
	    	echo $this->Session->flash('NewsletterRecipient');
	    } 
// 	if current user is registered
	    else if (($user['role_id']) >= '7') {
// check for newsletter subscription
	    	echo $user['email'];
	    };
	?>
</div>
