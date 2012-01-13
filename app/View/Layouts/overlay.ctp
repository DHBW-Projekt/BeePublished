<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title_for_layout?></title>
    <?php
    $this->Js->set('webroot', $this->request->webroot);
    echo $this->Html->css('/yaml/core/base');
    echo $this->Html->css('jquery-ui/jquery-ui-1.8.16.custom');
    echo $this->Html->css('design');
    echo $this->Html->css('template');
    echo $this->Html->script('jquery-1.6.2.min');
    echo $this->Html->script('jquery-ui-1.8.16.custom.min');
    echo $this->Html->script('jquery.fancybox-1.3.4.pack');
    echo $this->Html->script('jquery.blockUI');
    echo $this->Html->script('jquery.cookie');
    echo $scripts_for_layout;
    ?>
</head>
<body class="overlay">
<div id="overlay-header">
    <?php echo $this->Html->image('beelogo_small.png'); ?>
</div>
<div id="content">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout ?>
</div>
<div id="footer">
    Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012
</div>
</div>
<?php
echo $this->Js->writeBuffer(array('inline' => true));
?>
</body>
</html>