<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title_for_layout?></title>
    <?php echo $this->Html->css('/yaml/core/base'); ?>
    <?php echo $this->Html->css('main'); ?>
    <?php echo $this->Html->css('admin'); ?>
    <?php echo $this->Html->css('smoothness/jquery-ui-1.8.16.custom'); ?>
    <?php echo $this->Html->script('jquery-1.6.2.min'); ?>
    <?php echo $this->Html->script('jquery-ui-1.8.16.custom.min'); ?>
    <?php echo $this->Html->script('dualon'); ?>
    <?php echo $this->Html->script('admin'); ?>
</head>
<body>
<div id="main">
    <?php echo $this->element('admin-sidebar'); ?>
    <div id="header" class="ui-state-default">
        <div>DualonCMS Test-Umgebung</div>
    </div>
    <div id="menu" class="ui-state-default">
        <ul>
            <?php echo $this->element('menu', array('data' => $menu)); ?>
        </ul>
    </div>
    <div id="content">
        <?php echo $content_for_layout ?>
    </div>
    <div id="footer">
        Dieses Layout dient nur zum testen!
        <div>Kontakt | Impressum | DualonCMS c2011</div>
    </div>
</div>
</body>
</html>