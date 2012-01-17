<?php

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);

echo $this->element('admin_menu', array('contentID' => $contentID));
echo __("Information text on subscription view:").'<br><br>';
echo $this->Form->create('PluginText', array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterSettings',
		'action' => 'save', $contentID)));
echo $this->Form->textarea('Text', array(
	'label' => 'Text:',
	'rows' => 3,
	'type' => 'text',
	'name' => 'text',
	'value' => $pluginText['text']));
echo $this->Form->submit('Save');
echo $this->Form->end();