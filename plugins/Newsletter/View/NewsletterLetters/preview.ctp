<?php

echo $this->element('admin_menu', array('contentID' => $contentID));

if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	
	echo $this->Form->create('preview', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'send', $contentID, $newsletter['NewsletterLetter']['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => 'Betreff:', 
		'value' => $newsletter['NewsletterLetter']['subject']));
	echo $this->Form->textarea('NewsletterLetter.contentPreview', array(
		'label' => '', 
		'value' => $newsletter['NewsletterLetter']['content'],
		'rows' => '30'));
	echo $this->Form->submit('Send');
	echo $this->Form->end();	
};