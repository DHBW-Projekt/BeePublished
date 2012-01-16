<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?
    $this->Js->set('webroot', $this->request->webroot);
    echo $this->Html->css('admin/sortMenu');
    echo $this->Html->script('jquery/jquery-1.6.2.min');
    echo $this->Html->script('jquery/jquery-ui-1.8.16.custom.min');
    echo $this->Html->script('jquery/jquery.ui.nestedSortable');
    echo $this->Html->script('admin/sortMenu');
    ?>
</head>
<body>
<h1>Sort menu</h1>
<input type="button" class="saveButton" value="Save"/>
<?
echo '<ol class="nav">';
echo $this->element('menu', array('data' => $menu, 'adminMode' => true));
echo '</ol>';
?>
<input type="button" class="saveButton" value="Save"/>
<?php
echo $this->Js->writeBuffer(array('inline' => true));
?>
</body>
</html>