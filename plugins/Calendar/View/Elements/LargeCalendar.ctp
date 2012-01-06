<?php
$this->Html->css('/calendar/css/calendar', NULL, array('inline' => false));
$this->Html->script('/calendar/js/calendar', false);

echo $this->element($data['Page'],
    array(
        'StartTime' => $data['StartTime'],
        'FDOW' => $data['FirstDayOfWeek'],
        'ShowWeeks' => $data['ShowWeekCount'],
        'URL' => $url . '/'
    ), array('plugin' => 'Calendar'));
?>