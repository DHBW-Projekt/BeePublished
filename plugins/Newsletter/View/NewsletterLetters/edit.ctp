<?php

echo $this->element('admin_menu');

if (isset($newsletter)){
	
	$this->Html->script('/ckeditor/ckeditor', false);
	
	echo $this->Form->create('editor', array(
		'url' => array(
			'plugin' => 'Newsletter',
    		'controller' => 'NewsletterLetters',
    		'action' => 'save' , $newsletter['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => 'Betreff:', 
		'value' => $newsletter['subject']));
	echo $this->Form->textarea('NewsletterLetter.content', array(
		'label' => '', 
		'value' => $newsletter['content'],
		'rows' => '30'));
	echo $this->Form->button('Save', array(
		'type' => 'submit', 
		'value' => 'save'));
	echo $this->Form->button('Back', array(
		'type' => 'button',
	'onClick' => 'window.history.back()'));
// 		'onClick' => 'document.location.href=\'/plugin/Newsletter/NewsletterLetters/index/\';'));
	echo $this->Form->end();
	echo $this->Fck->load('NewsletterLetter.content');
}