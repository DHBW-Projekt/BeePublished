<?php
echo $this->element('config-menu');
echo __('Please select the social networks, that should be active in your website.');
echo $this->Form->create('Configuration', array('enctype' => 'multipart/form-data'));
//Social Network Configuration
echo $this->Form->input('facebook', array('label' => __('Facebook')));
echo $this->Form->input('twitter', array('label' => __('Twitter')));
echo $this->Form->input('googleplus', array('label' => 'Google+'));
echo $this->Form->input('xing', array('label' => __('Xing')));
echo $this->Form->input('linkedin', array('label' => __('LinkedIn')));
echo '<br>';
echo $this->Form->end(__('Save Configuration'));
?>
