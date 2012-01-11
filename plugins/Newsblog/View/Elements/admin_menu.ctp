<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link('Write News',array('controller' => 'NewsEntries', 'action' => 'create', $contentId));?></li>
        <li><?php echo $this->Html->link('Publish News',array('controller' => 'NewsEntries', 'action' => 'publish', $contentId));?></li>
        <li>General</li>
    </ol>
    <div style="clear:both;"></div>
</div>

