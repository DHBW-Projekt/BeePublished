<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title_for_layout?></title>
    <?php
    echo $this->Html->css('/yaml/core/base');
    echo $this->Html->css('/fancybox/jquery.fancybox-1.3.4');
    echo $this->Html->css('main');
    echo $this->Html->css('smoothness/jquery-ui-1.8.16.custom');
    echo $this->Html->script('jquery-1.6.2.min');
    echo $this->Html->script('jquery-ui-1.8.16.custom.min');
    echo $this->Html->script('jquery.fancybox-1.3.4.pack');
    echo $this->Html->script('jquery.blockUI');
    echo $this->Html->script('dualon');
    if ($adminMode) {
        echo $this->Html->css('sidebar');
        echo $this->Html->css('admin/layoutmanager');
        echo $this->Html->script('admin/layoutmanager');
        echo $this->Html->script('admin/main');
        echo $this->Html->script('admin/menu');
        echo $this->Html->script('admin/page');
        echo '<meta id="' . $pageid . '" />';
    }
    echo $scripts_for_layout;
    ?>
</head>
<body>
<div id="main">
    <div id="topnav" class="topnav">
        <?php
        if (AuthComponent::user('id') == null) {
            echo $this->element('login');
        } else {
            if (!$adminMode) {
                echo $this->Html->link('Admin Mode', '/admin' . $this->request->here);
            } else {
                $link = substr($this->request->here, 6);
                if ($link == "") $link = '/';
                echo $this->Html->link('User Mode', $link);
            }
            echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'signout'));
        }
        ?>
    </div>
    <div id="header" class="ui-state-default">
        <div>DualonCMS Test-Umgebung</div>
    </div>
    <div id="menu" class="ui-state-default">
        <ol class="nav" id="ul_0">
            <?php echo $this->element('menu', array('data' => $menu)); ?>
        </ol>
        <div class="sort">
            <?php
            if ($adminMode) {
                echo $this->Html->link(
                    $this->Html->image('sort.png'),
                    array('controller' => 'menuentries', 'action' => 'sort'),
                    array('escape' => false, 'class' => 'iframe')
                );
            }
            ?>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="content">
        <?php echo $content_for_layout ?>
    </div>
    <div id="footer">
        Dieses Layout dient nur zum testen!
        <div>Kontakt | Impressum | DualonCMS c2011</div>
    </div>
</div>
<? if ($adminMode) {
    echo $this->element('sidebar');
}
?>
</div>
</body>
</html>