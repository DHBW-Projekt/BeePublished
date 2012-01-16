<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>

<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>

<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link('Offene MitgliedsantrŠge',array('controller' => 'ApplicationForMembership', 'action' => 'admin', $contentID));?></li>
    </ol>

    <div style="clear:both;"></div>
</div>