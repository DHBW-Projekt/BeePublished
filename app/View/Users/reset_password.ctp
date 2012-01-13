 <div class="users form">
<?php
	echo $this->Form->create('User', array('action' => 'resetPassword'));
	echo $this->Form->input('username');
	echo $this->Form->input('email');
	echo $this->Form->end('Request a new password!');
?>
</div>