<?php
echo $this->Form->create('null');
echo $this->Form->input('Cryptkey');
echo $this->Form->input('Expire time', array('after' => ' in seconds'));
echo $this->Form->end(__d('file_share','save'));
?>