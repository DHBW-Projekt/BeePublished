<?php
$this->Html->script('jquery/jquery.relatedselects.min',false);
$this->Html->script('admin/configuration',false);
echo $this->element('config-menu');
echo $this->Form->create('Configuration', array('enctype' => 'multipart/form-data'));
echo $this->Form->input('active_template', array('options' => $themes, 'label' => __('Template:')));
echo $this->Form->input('active_design', array('options' => $designs, 'label' => __('Design:')));
echo '<div style="border:1px dotted #000000; width: 160px; height:120px; margin-left:135px">'. $this->Html->image('preview-default.jpg', array('id' => 'layout-preview')) .'</div>';
echo __("Size of logo should be 180x50 pixels").'<br/>';
echo $this->Form->label(__('Logo:'));
echo $this->Form->file('Configuration.submittedfile', array('label' => false));
echo '<div style="border:1px dotted #000000; margin-left:135px; width:180px; height: 50px">'.$this->Html->image('/uploads/logo.png').'</div>';
echo '<br>';
echo $this->Form->end(__('Save Layout & Design'));
?>
