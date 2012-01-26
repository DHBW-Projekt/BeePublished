<?php

echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));
echo $this->Session->flash('NewsletterSaved');

if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	echo $this->Form->create('editor', array(
		'url' => array(
			'plugin' => 'Newsletter',
    		'controller' => 'NewsletterLetters',
    		'action' => 'saveOrPreview' , $contentID, $pluginId, $newsletter['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => __d('newsletter','Subject:'), 
		'value' => $newsletter['subject']));
	if (isset($validationErrors['subject'][0])){
		echo $this->Html->div('validation_error',$validationErrors['subject'][0]);
	};
	echo $this->Form->textarea('NewsletterLetter.contentEdit', array(
		'label' => '', 
		'value' => $newsletter['content'],
		'rows' => '30'));
	echo $this->Form->submit(__d('newsletter','Save'), array(
		'name' => 'save',
		'div' => false));
	echo $this->Form->submit(__d('newsletter','Preview'), array(
			'name' => 'preview',
			'div' => false));
	echo $this->Form->end();
}