<?php

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

echo $this->element('admin_menu', array('contentID' => $contentID));
echo '<br>';
echo $this->Form->create('PluginText', array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterSettings',
		'action' => 'save', $contentID)));
echo 'Information text on subscription view:'.'<br>';
echo $this->Form->textarea('Text', array(
	'label' => 'Text:',
	'type' => 'text',
	'name' => 'text',
	'value' => $pluginText['text']));
echo '<br><br>';
echo 'Number of entries (Paginator):'.'<br>';
echo $this->Form->select('Paginator:', array(5,10,15,20), array(
	'label' => 'Paginator:',
	'escape' => false));
echo $this->Form->submit('Save');
echo $this->Form->end();