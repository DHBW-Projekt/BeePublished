<?php
$this->Html->css('/calendar/css/calendar', NULL, array('inline' => false));
$this->Html->script('/calendar/js/calendar', false);
echo $this->element($data['Page'],
    array(
        'StartTime' => $data['StartTime'],
        'FDOW' => $data['FirstDayOfWeek'],
        'ShowWeeks' => $data['ShowWeeks'],
        'URL' => $url . '/',
        'Entries' => $data['Entries'],
        'PluginId' => $pluginId
    ), array('plugin' => 'Calendar'));
?>