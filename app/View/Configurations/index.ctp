<?php
$this->Html->script('jquery/jquery.relatedselects.min',false);
$this->Html->script('ckeditor/ckeditor',false);
$this->Html->script('ckeditor/adapters/jquery',false);
$this->Html->script('admin/configuration',false);
echo $this->element('config-menu');
echo $this->Form->create('Configuration');
echo $this->Form->input('config_name');
echo $this->Form->input('page_name');
echo $this->Form->input('email');
echo $this->Form->input('active_template', array('options' => $themes));
echo $this->Form->input('active_design', array('options' => $designs));
echo $this->Form->input('status');
echo $this->Form->input('status-text', array('type' => 'textarea'));
echo $this->Form->end(__('Save Configuration'));
?>
