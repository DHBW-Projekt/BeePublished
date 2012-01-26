<?php echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'register')); ?> -
Have an account? <a href="login" class="signin">Login</a>
<fieldset id="signin_menu">
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')));?>
    <?php echo $this->Form->input('User.username'); ?>
    <?php echo $this->Form->input('User.password'); ?>

    <?php
    $options = array(
        'label' => 'Login',
        'id' => 'signin_submit'
    );
    echo $this->Form->end($options);
    ?>
    <div class="forgot"><?php echo $this->Html->link('Forgot your password?', array('controller' => 'Users', 'action' => 'resetPassword'), array('id' => 'resend_password_link'))?></div>
</fieldset>