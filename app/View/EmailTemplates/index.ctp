<?php 
	echo $this->element('config-menu');
	
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/emailtemplate',false);
?>	
<div>
	<?php
		echo $this->Form->create('EmailTemplate', array(
			'url' => array('controller' => 'EmailTemplates', 'action' => 'getAction')));
		echo '<div>';
		echo $this->Form->input('id', array(
			'value' => $selectedTemplate['EmailTemplate']['id'],
			'onChange' => 'document.forms[\'EmailTemplateIndexForm\'].submit();',
			'options' => $names,
			'label' => __('Template'),
			'div' => false));
		echo $this->Form->submit('/img/edit.png', array(
			'name' => 'EditTemplate', 
			'div' => false));
		echo $this->Form->submit('/img/delete.png', array(
			'name' => 'DeleteTemplate', 
			'div' => false,
			'onclick' => 'return confirm("Do you really want to delete the template?");'));
		echo '</div>';
		echo $this->Form->submit(__('Create new template'), array(
			'name' => 'CreateTemplate', 
			'div' => false));
		echo $this->Form->end();
	?>	
</div>
<br>
<hr>
<br>
<div>
	<h1>
		<?php echo __('Active Template: ').$selectedTemplate['EmailTemplate']['name'] ?>
	</h1>
	<?php
		echo $this->Form->textarea('EmailTemplates.Preview', array(
					'label' => '', 
					'value' => $selectedTemplate['EmailTemplate']['content'],
					'rows' => '30'));
	?>
</div>