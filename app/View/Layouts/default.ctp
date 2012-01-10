<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title_for_layout?></title>
    <?php
    $this->Js->set('webroot', $this->request->webroot);
    echo $this->Html->css('/yaml/core/base');
    echo $this->Html->css('/fancybox/jquery.fancybox-1.3.4');
    echo $this->Html->css('jquery-ui/jquery-ui-1.8.16.custom');
    echo $this->Html->css('design');
    echo $this->Html->css('template');
    echo $this->Html->css('menu-design');
    echo $this->Html->css('menu-template');
    echo $this->Html->script('jquery-1.6.2.min');
    echo $this->Html->script('jquery-ui-1.8.16.custom.min');
    echo $this->Html->script('jquery.fancybox-1.3.4.pack');
    echo $this->Html->script('jquery.blockUI');
    echo $this->Html->script('jquery.cookie');
    echo $this->Html->script('dualon');
    if ($adminMode) {
        $this->Js->set('pageid', $pageid);
        echo $this->Html->css('sidebar');
        echo $this->Html->css('admin/layoutmanager');
        echo $this->Html->script('admin/layoutmanager');
        echo $this->Html->script('admin/main');
        echo $this->Html->script('admin/menu');
        echo $this->Html->script('admin/page');
    }
    echo $scripts_for_layout;
    ?>
</head>
<body>
<div id="main">
    <div id="header">
        <div id="pagelogo">
            <?php
            echo $this->Html->link(
                $this->Html->image('beelogo.png'),
                '/',
                array('escape' => false)
            );
            ?>
        </div>
        <div id="topnav" class="topnav">
            <?php
            if (AuthComponent::user('id') == null) {
                echo $this->element('login');
            } else {
                $role = $this->PermissionValidation->getUserRole();
                if ($this->request->webroot != '/') {
                    $path = str_replace($this->request->webroot, '', $this->request->here);
                } else {
                    $path = substr($this->request->here, 1);
                }
                if (!$systemPage && ($role == 6 || $role == 7)) {
                    if (!$adminMode) {
                        echo $this->Html->link('Admin Mode', '/admin/' . $path);
                    } else {
                        $link = '/' . substr($path, 6);
                        echo $this->Html->link('User Mode', $link);
                    }
                }
                echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'signout'));
            }
            ?>
        </div>
    </div>
    <div id="menu">
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
        <?php echo $this->Session->flash(); ?>
        <?php echo $content_for_layout ?>
    </div>
    <div id="footer">
        Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012<br/><br/>
        <?php echo $this->element('sql_dump'); ?>
    </div>
</div>
<? if ($adminMode) {
    echo $this->element('sidebar');
}
?>
</div>
<?php
echo $this->Js->writeBuffer(array('inline' => true));
?>
</body>
</html>