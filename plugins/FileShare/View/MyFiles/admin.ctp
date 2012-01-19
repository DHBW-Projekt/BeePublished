<?php
echo $this->Form->create('null');
echo $this->Form->input('Cryptkey');
echo $this->Form->input('Expire time');
echo $this->Form->end(__('save'));
?>