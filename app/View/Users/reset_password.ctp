 <div class="users form">
<?php
	echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'resetPassword')));
	echo $this->Form->input('username', array('label' => __('Username:')));
	echo $this->Form->input('email', array('label' => __('Old Password:')));
	echo $this->Form->end(_('Request a new password!'));
?>
</div>