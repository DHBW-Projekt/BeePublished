<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__d('Guestbook','Unreleased posts'),array('plugin' => 'Guestbook', 'controller' => 'Guestbook', 'action' => 'admin', $contentId), array('title' => __d('Guestbook', 'Unreleased posts')));?></li>
        <li><?php echo $this->Html->link(__d('Guestbook','Settings'),array('plugin' => 'Guestbook', 'controller' => 'Guestbook', 'action' => 'settings', $contentId), array('title' => __d('Guestbook', 'Settings')));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>