<?php 
	echo $this->element('config-menu');
	
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/ckeditor',false);
?>	
<div>
<?php
	echo $this->Form->create('EmailTemplate', array('url' => array('controller' => 'EmailTemplates', 'action' => 'showOrCreate')));
	echo $this->Form->input('id', array('options' => $names, 'label' => __('Template:')));
	echo $this->Form->submit(__('Create new template'), array('name' => 'CreateTemplate', 'div' => false));
	echo $this->Form->submit(__('Show template'), array('name' => 'ShowTemplate', 'div' => false));
	echo $this->Form->end();
?>	
</div>
<br>
<hr>
<br>
<div>
<h1>
<?php echo __('Selected Template: ').$selectedTemplate['EmailTemplate']['name'] ?></h1>
<?php
	echo $this->Form->textarea('EmailTemplates.Preview', array(
				'label' => '', 
				'value' => $selectedTemplate['EmailTemplate']['content'],
				'rows' => '30'));
?>
<?php
	echo $this->Html->link($this->Html->image('edit.png', array('width' => '20', 'height' => '20', 'alt' => __('[x]Edit'))),array('controller' => 'EmailTemplates', 'action' => 'edit', $selectedTemplate['EmailTemplate']['id']),array('escape' => false));
	echo $this->Html->link($this->Html->image('delete.png', array('width' => '20', 'height' => '20', 'alt' => __('[x]Delete'))),array('controller' => 'EmailTemplates', 'action' => 'delete', $selectedTemplate['EmailTemplate']['id']),array('escape' => false));
	echo $this->Form->create('EmailTemplate');
	echo $this->Form->submit(__('Activate Template'), array('name' => 'ActivateTemplate'));
	echo $this->Form->end();
?>	
</div>