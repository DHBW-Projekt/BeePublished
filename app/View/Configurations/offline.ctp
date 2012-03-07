<?php
$this->Html->script('jquery/jquery.relatedselects.min',false);
$this->Html->script('ckeditor/ckeditor',false);
$this->Html->script('ckeditor/adapters/jquery',false);
$this->Html->script('admin/configuration',false);
echo $this->element('config-menu');
echo $this->Form->create('Configuration');
echo $this->Form->input('status', array('label' => __('Page is online')));
echo $this->Form->input('status_text', array('type' => 'textarea'));
echo '<br>';
echo $this->Form->end(__('Save page status'));
?>
