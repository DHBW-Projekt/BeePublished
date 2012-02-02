<?php

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));
echo '<h1>'.__d('newsletter','Information text on subscription view:').'</h1>';
echo $this->Session->flash('TextSaved');
echo $this->Form->create('PluginText', array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterSettings',
		'action' => 'save', $contentID, $pluginId)));

echo $this->Form->textarea('Text', array(
	'label' => 'Text:',
	'type' => 'text',
	'name' => 'text',
	'value' => $pluginText['text']));
echo $this->Form->submit(__d('newsletter','Save'));
echo $this->Form->end();