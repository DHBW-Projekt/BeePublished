<?php $this->Html->css('menu-design', NULL, array('inline' => false)); ?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false)); ?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__('Users'), array('controller' => 'Users', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('General Configuration'), array('controller' => 'Configurations', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Plugins'), array('controller' => 'Plugins', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Permissions'), array('controller' => 'Permissions', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Email Templates'), array('controller' => 'EmailTemplates', 'action' => 'index'));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>
