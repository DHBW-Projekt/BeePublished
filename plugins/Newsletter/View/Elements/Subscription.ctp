<?php
	$user = $this->Session->read('Auth.User'); // get data for current user
	$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
	$this->Html->script('/newsletter/js/newsletter', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
?>
<div id="subscription">
	<?php
	
//		if (($user['role_id']) == '2') {
		
		if (!($user)){	
			echo $this->Form->create('Subscription',array('url' => array('plugin' => 'Newsletter',
																	   		  	'controller' 	  => 'Subscription',
																	   		  	'action'  	      => 'guestUnSubscribe')));
			echo $this->Form->input('NewsletterRecipient.email', array('label' => 'E-Mail:'));
//			echo $this->Fck->load('NewsletterRecipient.email');
			echo $this->Html->div('validation_error',$validationErrors['email'][0]);
    		echo $this->Form->end('(Un)subscribe');
    		echo $this->Session->flash('NewsletterRecipient');
	    } 
		// 	if current user is registered
	    else if ($user) {
			// check for newsletter subscription
// 	    	debug($data['userAsRecipient'], $showHtml=null, $showFrom=true);
	    	$userAsRecipient = $data['userAsRecipient'];
	    	echo $this->Form->create('UserSubscription', array('url' => array('plugin' => 'Newsletter',
	    																	'controller' => 'Subscription',
	    																	'action' => 'userUnSubscribe')));
			if ((isset($userAsRecipient)) and ($userAsRecipient['NewsletterRecipient']['active'] == 1)){
				echo 'You subscribed for the newsletter';
				echo $this->Form->end('Unsubscribe');
			} else {
				echo 'You didn\'t subscribe for the newsletter';
				echo $this->Form->end('Subscribe');
			};
// 	    	echo $user['email'];
//	    	echo '<br>'.$plugin.'<br>'.$view.'<br>'.$id;
			// if current user is admin (change later: role_id >= 4), for development: >= 3
// 		   	echo $this->Html->link(
// 	      		$this->Html->image('tools.png', array('class' => 'setting_image')),
// 	       		array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'content'),
// 	      		array('escape' => False, 'class' => 'newsletter-overlay') //, 'class' => 'setting_button')
// 	    	);
      	};
	?>
</div>
