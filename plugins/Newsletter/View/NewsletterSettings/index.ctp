<?php

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);

echo $this->element('admin_menu', array('contentID' => $contentID));
echo $this->Form->create('PluginText', array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterSettings',
		'action' => 'save', $contentID)));
echo $this->Form->textarea('Text', array(
	'label' => 'Text:',
	'type' => 'text',
	'name' => 'text',
	'value' => $pluginText['text']));
echo $this->Form->button('Save', array(
	'type' => 'submit',
	'value' => 'save'));
echo $this->Form->end();