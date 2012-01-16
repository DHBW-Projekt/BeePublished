<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link('Pending posts',array('plugin' => 'Guestbook', 'controller' => 'Guestbook', 'action' => 'admin'));?></li>
        <li><?php echo $this->Html->link('Settings',array('plugin' => 'Guestbook', 'controller' => 'Guestbook', 'action' => 'index'));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>