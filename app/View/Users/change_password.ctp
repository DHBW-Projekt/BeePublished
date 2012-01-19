 <div class="users form">
<?php
	echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'changePassword')));
	echo $this->Form->hidden('id',array(
			'name' => 'id',
			'value' => $this->Session->read('Auth.User.id')
		));
	echo $this->Form->input('current_password', array('type' => 'password', 'label' => 'Old Password:'));
	echo $this->Form->input('password', array('type' => 'password', 'label' => 'New Password:'));
	echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Confirm Password:'));
	echo $this->Form->end('Change password!');
?>
</div>