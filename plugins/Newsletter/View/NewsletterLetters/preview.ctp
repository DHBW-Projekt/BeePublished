<?php

echo $this->element('admin_menu');

if (isset($newsletter)){
	
	$this->Html->script('/ckeditor/ckeditor', false);
	
	echo $this->Form->create('preview', array(
				'url' => array(
					'plugin' => 'Newsletter',
		    		'controller' => 'NewsletterLetters',
		    		'action' => 'send' , $newsletter['NewsletterLetter']['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
				'label' => 'Betreff:', 
				'value' => $newsletter['NewsletterLetter']['subject']));
	echo $this->Form->textarea('NewsletterLetter.content', array(
				'label' => '', 
				'value' => $newsletter['NewsletterLetter']['content'],
				'rows' => '30'));
	echo $this->Form->button('Send', array(
				'type' => 'submit', 
				'value' => 'save'));
	echo $this->Form->button('Back', array(
				'type' => 'button',
				'onClick' => 'window.history.back()'));
// 				'onClick' => 'location.href=\'/plugin/Newsletter/Subscription/newsletteradmin/\';'));
	echo $this->Form->end();
		
		
	echo $this->Html->scriptBlock('
				CKEDITOR.replace( \'NewsletterLetterContent\',
									{
       									readOnly : \'true\',
    								});
				'
	, array('inline' => true));


	
};