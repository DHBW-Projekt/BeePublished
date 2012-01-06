<?php
echo $this->element('CalendarFactory',
    array(
        'FDOW' => $FDOW,
        'ShowWeeks' => $ShowWeeks,
        'time' => $StartTime,
        'ClassPrefix' => '',
        'url' => $URL,
        'navigation' => true
    ),
    array('plugin' => 'Calendar'));
?>