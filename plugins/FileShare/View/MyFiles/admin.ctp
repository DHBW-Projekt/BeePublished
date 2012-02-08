<?php
echo $this->Form->create('null');
echo $this->Form->input(__d('file_share','Cryptkey'));
echo $this->Form->input(__d('file_share','Expire time'), array('after' => __d('file_share',' in seconds')));
echo $this->Form->end(__d('file_share','save'));
?>