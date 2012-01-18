<?php

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

echo $this->element('admin_menu', array('contentID' => $contentID));
echo '<h1>'.__('Information text on subscription view:').'</h1><br>';
echo $this->Session->flash('TextSaved');
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
echo $this->Form->submit(__('Save'));
echo $this->Form->end();