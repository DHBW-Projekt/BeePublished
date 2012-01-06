<?php
$this->Html->css('/calendar/css/calendar', NULL, array('inline' => false));
$this->Html->script('/calendar/js/calendar', false);
if ($data['page'] == null) {
    $data['page'] = $url;
}
if (substr($data['page'],-1) != '/') {
    $data['page'] .= '/';
}
foreach ($data['Months'] as $month) {
    echo $this->element('CalendarFactory',
        array(
            'FDOW' => $data['FirstDayOfWeek'],
            'ShowWeeks' => $data['ShowWeekCount'],
            'time' => $month,
            'ClassPrefix' => 'small_',
            'url' => $data['page'],
            'navigation' => false
        ),
        array('plugin' => 'Calendar'));
}
?>