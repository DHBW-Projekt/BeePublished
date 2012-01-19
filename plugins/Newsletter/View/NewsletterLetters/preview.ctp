<?php

echo $this->element('admin_menu', array('contentID' => $contentID));

if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	echo $this->Session->flash('NewsletterSent');
	echo $this->Form->create('preview', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'sendOrEdit', $contentID, $newsletter['NewsletterLetter']['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => __('Subject:'), 
		'value' => $newsletter['NewsletterLetter']['subject']));
	echo $this->Form->textarea('NewsletterLetter.contentPreview', array(
		'label' => '', 
		'value' => $newsletter['NewsletterLetter']['content'],
		'rows' => '30'));
	if ($newsletter['NewsletterLetter']['draft'] == 1){
		echo $this->Form->submit(__('Send'), array(
			'name' => 'send',
			'div' => false));
		echo $this->Form->submit(__('Edit'), array(
			'name' => 'edit',
			'div' => false));
	} else {
		echo __('This newsletter has been sent on ').$newsletter['NewsletterLetter']['date']; 
	};
	echo $this->Form->end();	
};