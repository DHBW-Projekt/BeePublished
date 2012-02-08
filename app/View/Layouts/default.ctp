<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	 <?php echo $this->Html->charset('UTF-8'); ?>
    <title><?php echo $title_for_layout?></title>
    <?php
    $this->Js->set('webroot', $this->request->webroot);
    echo $this->Html->css('yaml/core/base');
    echo $this->Html->css('fancybox/jquery.fancybox-1.3.4');
    echo $this->Html->css('admin/flashmessages');
    echo $this->Html->css('designs/' . $design);
   
    if ($mobile) {
        echo $this->Html->css('mobile');
    ?>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"></meta>
    <?php
    } else {
        echo $this->Html->css('template');
    }
    echo $this->Html->css('menu-design');
    echo $this->Html->css('menu-template');
    echo $this->Html->script('jquery/jquery-1.6.2.min');
    echo $this->Html->script('jquery/jquery-ui-1.8.16.custom.min');
    echo $this->Html->script('jquery/jquery.fancybox-1.3.4.pack');
    echo $this->Html->script('jquery/jquery.blockUI');
    echo $this->Html->script('jquery/jquery.cookie');
    echo $this->Html->script('dualon');
    echo $this->Html->script('menu');
    if ($adminMode) {
        if (isset($pageid)) {
            $this->Js->set('pageid', $pageid);
        }
        echo $this->Html->css('admin/sidebar');
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
                $this->Html->image('beelogo_w_small.png'),
                '/',
                array('escape' => false)
            );
            ?>
        </div>
        <div id="topnav" class="topnav">
            <div id="topnav-content">
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
                    echo $this->Html->link(AuthComponent::user('username'), array('controller' => 'Users', 'action' => 'changePassword'), array('class' => 'signout'));
                    echo $this->Html->link('Logout', array('controller' => 'Users', 'action' => 'logout'), array('class' => 'signout'));
                }
                ?>
            </div>
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
                    array('controller' => 'MenuEntries', 'action' => 'sort'),
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
        Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012
    </div>
</div>
<?php if ($adminMode) {
    echo $this->element('sidebar');
}
?>
<?php
echo $this->Js->writeBuffer(array('inline' => true));
?>
</body>
</html>