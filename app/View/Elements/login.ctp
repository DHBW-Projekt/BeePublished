<?php echo $this->Html->link(__('Register'), array('controller' => 'Users', 'action' => 'register')); ?> -
<?php 
echo __('Have an account?') ?>
<a href="login" class="signin"> <?php echo __('Login') ?> </a>
<fieldset id="signin_menu">
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')));?>
    <?php echo $this->Form->input('User.username'); ?>
    <?php echo $this->Form->input('User.password'); ?>

    <?php
    $options = array(
        'label' => __('Login'),
        'id' => 'signin_submit'
    );
    echo $this->Form->end($options);
    ?>
    <div class="forgot"><?php echo $this->Html->link(__('Forgot your password?'), array('controller' => 'Users', 'action' => 'resetPassword'), array('id' => 'resend_password_link'))?></div>
</fieldset>