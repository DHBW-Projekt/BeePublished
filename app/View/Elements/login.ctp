<?php echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'register')); ?> -
Have an account? <a href="login" class="signin">Login</a>
<fieldset id="signin_menu">
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')));?>
    <?php echo $this->Form->input('User.username'); ?>
    <?php echo $this->Form->input('User.password'); ?>

    <?php
    $options = array(
        'label' => 'Login',
        'id' => 'signin_submit',
        'class' => 'button'
    );
    echo $this->Form->end($options);
    ?>
    <div class="forgot"><a href="#" id="resend_password_link">Forgot your password?</a></div>
</fieldset>