<h2>Login</h2>
<?php
echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')));
echo $this->Form->input('User.username', array('label' => __('Username:')));
echo $this->Form->input('User.password', array('label' => __('Password:')));
echo $this->Form->end(__('Login'));
?>