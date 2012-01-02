<div id="sidebar">
    <div id="sidebar-opener" class="closed"><img src="/img/tools.png" width="32" height="32"/></div>
    <div id="sidebar-shadow"></div>
    <div id="sidebar-top">
        <div id="logo"><img src="/img/logo.png"/></div>
        <h1>BeePublished</h1>
        <hr/>
        <div class="button-bar">
            <?php echo $this->Html->image("group.png", array(
            'alt' => __('User Management'),
            'url' => array('controller' => 'user', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
            <?php echo $this->Html->image("system.png", array(
            'alt' => __('User Management'),
            'url' => array('controller' => 'user', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
            <?php echo $this->Html->image("box.png", array(
            'alt' => __('User Management'),
            'url' => array('controller' => 'user', 'action' => 'index'),
            'class' => 'small-button',
            'width' => 20,
            'height' => 20
        ));
            ?>
        </div>
        <hr/>
    </div>
    <div id="sidebar-content">
        <div id="sidebar-menu" class="ui-state-default" style="height:100%">
            <h3><a href="#">Plugin</a></h3>
            <div id="plugins">
            </div>
            <h3><a href="#">Layout</a></h3>
            <div id="layouts"></div>
        </div>
    </div>
</div>