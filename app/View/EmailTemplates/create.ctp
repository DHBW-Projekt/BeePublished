<?php
	echo $this->element('config-menu');
	
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/ckeditor',false);
	
	echo $this->Form->create('EmailTemplate', array(
		'url' => array(
    		'controller' => 'EmailTemplates',
    		'action' => 'save')));
	echo $this->Form->input('name', array(
		'label' => 'Name:', 
		'value' => ''));
	echo $this->Form->textarea('content', array(
		'label' => '', 
		'value' => '',
		'rows' => '30'));
	echo $this->Form->end('Save');
?>