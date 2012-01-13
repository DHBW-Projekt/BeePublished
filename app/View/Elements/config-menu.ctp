<?php $this->Html->css('menu-design', NULL, array('inline' => false)); ?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false)); ?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link('General Configuration', array('controller' => 'configurations', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link('Plugins', array('controller' => 'plugins', 'action' => 'index'));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>
