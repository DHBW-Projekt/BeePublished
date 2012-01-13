<?php
echo $this->element('config-menu');
echo $this->Form->create('Configuration');
echo $this->Form->input('config_name');
echo $this->Form->input('page_name');
echo $this->Form->input('email');
echo $this->Form->input('active_design');
echo $this->Form->input('active_template');
echo $this->Form->input('status');
echo $this->Form->input('status-text');
echo $this->Form->end(__('Save Configuration'));
?>
