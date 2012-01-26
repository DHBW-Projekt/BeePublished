 <div class="users form">
<?php
	echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'resetPassword')));
	echo $this->Form->input('username');
	echo $this->Form->input('email');
	echo $this->Form->end('Request a new password!');
?>
</div>