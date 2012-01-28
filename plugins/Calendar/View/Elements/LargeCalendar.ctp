<?php
$this->Html->css('/calendar/css/calendar', NULL, array('inline' => false));
$this->Html->script('/calendar/js/calendar', false);
if ($data['Page'] == 'Detail') {
    echo $this->element($data['Page'],
            array(
                'URL' => $url . '/',
                'Entry' => $data['Entry'],
                'PluginId' => $pluginId
            ), array('plugin' => 'Calendar'));
} else {
    echo $this->element($data['Page'],
        array(
            'StartTime' => $data['StartTime'],
            'FDOW' => $data['FirstDayOfWeek'],
            'ShowWeeks' => $data['ShowWeeks'],
            'URL' => $url . '/',
            'Entries' => $data['Entries'],
            'MonthEntries' => $data['MonthEntries'],
            'PluginId' => $pluginId
        ), array('plugin' => 'Calendar'));
}
?>