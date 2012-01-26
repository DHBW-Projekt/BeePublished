<h2>Login</h2>
<?php
echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')));
echo $this->Form->input('User.username');
echo $this->Form->input('User.password');
echo $this->Form->end('Login');
?>