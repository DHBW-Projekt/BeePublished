<?php

echo $this->element('config-menu');

if (isset($newsletter)){
	
	$this->Html->script('/ckeditor/ckeditor', false);;
	$this->Html->script('/ckeditor/adapters/jquery',false);
	$this->Html->script('/js/ckeditor',false);
	
	echo $this->Form->create('editor', array(
		'url' => array(
    		'controller' => 'EmailTemplates',
    		'action' => 'save' , $newsletter['id'])));
	echo $this->Form->input('EmailTemplates.Title', array(
		'label' => 'Betreff:', 
		'value' => $newsletter['subject']));
	echo $this->Form->textarea('NewsletterLetter.contentEdit', array(
		'label' => '', 
		'value' => $newsletter['content'],
		'rows' => '30'));
	echo $this->Form->button('Save', array(
		'type' => 'submit', 
		'value' => 'save'));
	echo $this->Form->end();
}