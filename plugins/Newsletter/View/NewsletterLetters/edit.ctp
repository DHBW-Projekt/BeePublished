<?php

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
    		'action' => 'save' , $contentID, $newsletter['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => 'Betreff:', 
		'value' => $newsletter['subject']));
	echo $this->Form->textarea('NewsletterLetter.contentEdit', array(
		'label' => '', 
		'value' => $newsletter['content'],
		'rows' => '30'));
	echo $this->Form->submit('Save');
	echo $this->Form->end();
}