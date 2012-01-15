<?php 
	echo $this->element('config-menu');
	
	$this->Html->script('/ckeditor/ckeditor', false);;
	$this->Html->script('/ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/ckeditor',false);
	
	
	$options = array('M' => 'Male', 'F' => 'Female');
	$attributes = array('legend' => false);
	echo $this->Form->radio('gender', $options, $attributes);
	
	echo $this->Form->textarea('EmailTemplates.Preview', array(
				'label' => '', 
				'value' => 'TestValue',
				'rows' => '30'));
?>