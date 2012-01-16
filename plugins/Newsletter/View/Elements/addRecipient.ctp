<?php
	$user = $this->Session->read('Auth.User'); // get data for current user
	$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
	$this->Html->script('/newsletter/js/newsletter', false);
	$this->Html->script('ckeditor/ckeditor', false);
?>
<div id="subscription">
	<?php
	
		echo $this->Form->create('Subscription',array('url' => array('plugin' => 'Newsletter',
												   		  	'controller' 	  => 'Subscription',
												   		  	'action'  	      => 'addRecipient')));
		echo $this->Form->input('NewsletterRecipient.email', array('label' => 'E-Mail:'));
		echo $this->Html->div('validation_error',$validationErrors['email'][0]);
    	echo $this->Form->end('Add');
    	echo $this->Session->flash('NewsletterRecipient');

	?>
</div>
