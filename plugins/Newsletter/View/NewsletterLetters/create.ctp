<?php

$validationErrors = $this->Session->read('Validation.NewsletterLetter.validationErrors');

echo $this->element('admin_menu', array('contentID' => $contentID));
echo $this->Session->flash('NewsletterSaved');
if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	echo $this->Form->create('editor', array(
		'url' => array(
			'plugin' => 'Newsletter',
    		'controller' => 'NewsletterLetters',
    		'action' => 'saveNew', $contentID)));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => __('Subject:')));
	if (isset($validationErrors['subject'][0])){
		echo $this->Html->div('validation_error',$validationErrors['subject'][0]);
	};
	echo $this->Form->textarea('NewsletterLetter.contentEdit', array(
		'label' => '', 
		'rows' => '30',
		'value' => $newsletter['content']));
	echo $this->Form->submit(__('Save'));
	echo $this->Form->end();
}