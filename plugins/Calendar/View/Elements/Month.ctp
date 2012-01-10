<?php
echo $this->element('CalendarFactory',
    array(
        'FDOW' => $FDOW,
        'ShowWeeks' => $ShowWeeks,
        'time' => $StartTime,
        'ClassPrefix' => '',
        'url' => $URL,
        'navigation' => true,
        'Entries' => $Entries,
        'ShowEntries' => true,
        'PluginId' => $PluginId
    ),
    array('plugin' => 'Calendar'));
?>