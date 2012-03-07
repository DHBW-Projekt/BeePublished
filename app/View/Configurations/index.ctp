<?php
echo $this->element('config-menu');
echo $this->Form->create('Configuration');
echo $this->Form->input('page_name', array('label' => __('Page name:')));
echo $this->Form->input('email', array('label' => __('Email:')));
$options = array('eng' => __('English'), 'deu' => __('German'));
echo $this->Form->label('title', __('Language:'));
echo $this->Form->select('language', $options, array('empty'=>false, 'default' => $this->request->data['Configuration']['language']));
echo "<br/><br/>";
echo $this->Form->end(__('Save Configuration'));
?>
