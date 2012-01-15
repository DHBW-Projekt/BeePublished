<div id="sidebar">
    <div id="sidebar-opener"
         class="closed"><?php echo $this->Html->image("tools.png", array('width' => 32, 'height' => 32)); ?></div>
    <div id="sidebar-shadow"></div>
    <div id="sidebar-top">
        <div id="logo"><?php echo $this->Html->image("beelogo.png", array('width' => 180)); ?></div>
        <hr/>
        <div class="button-bar">
            <?php echo $this->Html->image("group.png", array(
            'alt' => __('User Management'),
            'url' => array('controller' => 'Users', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
            <?php echo $this->Html->image("system.png", array(
            'alt' => __('User Management'),
            'url' => array('controller' => 'Configurations', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
            <?php echo $this->Html->image("box.png", array(
            'alt' => __('Plugin Management'),
            'url' => array('controller' => 'Plugins', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
        </div>
        <hr/>
    </div>
    <div id="sidebar-tabs">
        <ul>
            <li><a href="#layouts" title="layouts" class="tab selected-tab">Layouts</a></li>
            <li><a href="#plugins" title="plugins" class="tab">Plugins</a></li>
        </ul>
    </div>
    <div id="sidebar-content">
        <div id="layouts" class="tab-content"></div>
        <div id="plugins" class="tab-content" style="display:none"></div>
    </div>
</div>