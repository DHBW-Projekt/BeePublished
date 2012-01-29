<?php
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
debug($validationErrors);
echo __d('newsletter', 'Here you can unsubscribe from our newsletter');
	echo $this->Session->flash('unsubscribePerMail');
	echo $this->Form->create('Subscription',array(
			'url' => array(
				'plugin' => 'Newsletter',
				'controller' => 'Subscription',
				'action' => 'unsubscribe')));
		echo $this->Form->input('NewsletterRecipient.email', array(
			'label' => __d('newsletter','E-Mail:'),
			'value' => $email ));
		echo $this->Html->div('validation_error',$validationErrors['email'][0]);
   		echo $this->Form->end(__d('newsletter','Unsubscribe'));

?>