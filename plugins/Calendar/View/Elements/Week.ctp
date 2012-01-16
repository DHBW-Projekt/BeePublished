<?php
$days = array(__('So'), __('Mo'), __('Di'), __('Mi'), __('Do'), __('Fr'), __('Sa'));
for ($i = 0; $i < $FDOW; $i++) {
	array_push($days, array_shift($days));
}
$dayTimes = array();
for ($i = 0; $i < 7; $i++) {
	$dayTimes[] = $StartTime;
	$StartTime = strtotime('+1 days', $StartTime);
}
?>
<div class="calendar">
<div class="calendar_head">
<div class="month_minus"><?php echo $this->Html->link('<< KW ' . date('W', strtotime('-1 weeks', $StartTime)), $URL . 'largecalendar/week/' . date('Y-\WW', strtotime('-1 weeks', $StartTime)));?></div>
<div class="month_plus"><?php echo $this->Html->link('KW ' . date('W', strtotime('+1 weeks', $StartTime)) . ' >>', $URL . 'largecalendar/week/' . date('Y-\WW', strtotime('+1 weeks', $StartTime)));?></div>
<div class="calendar_name">Calendar Week <?php echo date('W: d M Y', $StartTime) . ' - ' . date('d M Y', strtotime('+1 week -1 day', $StartTime));?></div>
</div>
<table cellspacing="0">
	<thead>
		<tr>
			<th></th>
			<?php foreach ($days as $day): ?>
			<th><?php echo $day;?></th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<th></th>
			<?php foreach ($dayTimes as $day): ?>
			<th><?php echo date('d.m.', $day);?> <?php echo $this->Html->link($this->Html->image('add.png', array('width' => 18, 'height' => 18)), array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'add', date('Y-m-d', $day)), array('escape' => false, 'class' => 'calendar_add_entry')); ?>
			</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php
        echo '<tr>';
        echo '<td class="calendar_time"></td>';
        for ($j = 0; $j < 7; $j++) {
            $date = date('Y-m-d', $dayTimes[$j]);
            if (!array_key_exists($date, $Entries)) {
                echo '<td></td>';
            } else {
                echo '<td class="calendar_no_time">';
                $calendarEntries = $Entries[$date];
                foreach ($calendarEntries as $entry) {
                    if (!$entry['notime']) break;
                    echo '<div class="calendar_entry notime">';
                    echo '<div class="calendar_entry_content">' . $entry['name'] . '</div>';
                    echo '</div>';
                }
                echo '</td>';
            }
        }
        echo '</tr>';
        for ($i = 0; $i < 48; $i++) {
            if ($i % 2 == 0) {
                $fullHourClass = ' full_hour';
            } else {
                $fullHourClass = ' half_hour';
            }
            echo '<tr>';
            echo '<td class="calendar_time' . $fullHourClass . '">';
            echo date('H:i', $StartTime);
            echo '</td>';
            for ($j = 0; $j < 7; $j++) {
                $date = date('Y-m-d', $dayTimes[$j]);
                if (!array_key_exists($date, $Entries)) {
                    echo '<td class="' . $fullHourClass . '"></td>';
                } else {
                    $slotStart = $dayTimes[$j];
                    $slotEnd = strtotime('+29 minutes', $dayTimes[$j]);
                    echo '<td class="' . $fullHourClass . '">';
                    $calendarEntries = $Entries[$date];
                    foreach ($calendarEntries as $entry) {
                        if ($entry['notime']) continue;
                        $eventStart = strtotime($date . ' ' . $entry['start_time']);
                        if ($eventStart < $slotStart || $eventStart > $slotEnd) continue;
                        echo '<div class="calendar_entry notime">';
                        echo '<div class="calendar_entry_time_start">';
                        echo substr($entry['start_time'], 0, 5);
                        echo '</div>';
                        echo '<div class="calendar_entry_content">' . $entry['name'] . '</div>';
                        echo '</div>';
                    }
                    echo '</td>';
                }
            }
            echo '</tr>';
            $StartTime = strtotime('+30 minutes', $StartTime);
            foreach ($dayTimes as $idx => $dayTime) {
                $dayTimes[$idx] = strtotime('+30 minutes', $dayTime);
            }
        }
        /*$numOfDays = cal_days_in_month(CAL_GREGORIAN, date('n', $time), date('Y', $time));
        for ($j = 0; $j < $numOfDays; $j++) {
            $day = date('Y-m-d', $time);
            if ($currentColumn == 0) {
                echo '<tr>';
                if ($ShowWeeks) {
                    echo '<td class="' . $ClassPrefix . 'week">' . $this->Html->link(date('W', $time), $url . 'largecalendar/week/' . date('Y-\WW', $time)) . '</td>';
                }
                if ($currentRow == 0) {
                    $colspan = -$FDOW + date('N', $time);
                    if ($colspan == 7) $colspan = 0;
                    if ($colspan == 1) {
                        echo '<td class="' . $ClassPrefix . 'no_date"></td>';
                    } elseif ($colspan > 1) {
                        echo '<td colspan="' . $colspan . '" class="' . $ClassPrefix . 'no_date"></td>';
                    }
                    $currentColumn += $colspan;
                }
            }
            if (array_key_exists(date('Y-m-d', $time), $Entries)) {
                $hasDateClass = ' class="has-date"';
            } else {
                $hasDateClass = '';
            }
            echo '<td' . $hasDateClass . '>';
            echo '<div class="' . $ClassPrefix . 'calendar_date">';
            echo $this->Html->link(date('j', $time), $url . 'largecalendar/day/' . date('Y-m-d', $time));
            if ($navigation && $this->PermissionValidation->actionAllowed($PluginId, 'CreateEvent')) {
                echo ' ' . $this->Html->link($this->Html->image('add.png', array('width' => 12, 'height' => 12)), array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'add', date('Y-m-d', $time)), array('escape' => false, 'class' => 'calendar_add_entry'));
            }
            echo '</div>';
            echo '<div class="' . $ClassPrefix . 'calendar_content">';
            if ($ShowEntries && array_key_exists($day, $Entries)) {
                foreach ($Entries[$day] as $entry) {
                    if ($entry['notime']) {
                        $notimeClass = ' notime';
                    } else {
                        $notimeClass = '';
                    }
                    echo '<div class="' . $ClassPrefix . 'calendar_entry' . $notimeClass . '">';
                    if (!$entry['notime']) {
                        echo '<div class="' . $ClassPrefix . 'calendar_entry_time_start">';
                        echo substr($entry['start_time'], 0, 5);
                        echo '</div>';
                    }
                    echo '<div class="' . $ClassPrefix . 'calendar_entry_content">' . $entry['name'] . '</div>';
                    echo '</div>';
                }
            }
            echo '</div>';
            echo '</td>';
            $time += 86400;
            $currentColumn++;
            if ($currentColumn == 7) {
                echo '</tr>';
                $currentRow++;
                $currentColumn = 0;
            }
        }
        if ($currentColumn > 0) {
            echo '<td colspan="' . (7 - $currentColumn) . '" class="' . $ClassPrefix . 'no_date"></td></tr>';
        }*/
        ?>
	</tbody>
</table>
</div>
