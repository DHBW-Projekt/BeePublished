<?php
$days = array(__('So'), __('Mo'), __('Di'), __('Mi'), __('Do'), __('Fr'), __('Sa'));
for ($i = 0; $i < $FDOW; $i++) {
    array_push($days, array_shift($days));
}
$currentColumn = 0;
$currentRow = 0;
?>
<div class="<?php echo $ClassPrefix; ?>calendar">
    <div class="<?php echo $ClassPrefix; ?>calendar_head">
        <?php if ($navigation) : ?>
        <div
            class="<?php echo $ClassPrefix; ?>month_minus"><?php echo $this->Html->link('<< ' . date('M y', strtotime('-1 months', $time)), $url . 'largecalendar/month/' . date('Y-m', strtotime('-1 months', $time)));?></div>
        <div
            class="<?php echo $ClassPrefix; ?>month_plus"><?php echo $this->Html->link(date('M y', strtotime('+1 months', $time)) . ' >>', $url . 'largecalendar/month/' . date('Y-m', strtotime('+1 months', $time)));?></div>
        <?php endif; ?>
        <div
            class="<?php echo $ClassPrefix; ?>calendar_name"><?php echo $this->Html->link(date('F Y', $time), $url . 'largecalendar/month/' . date('Y-m', $time));?></div>
    </div>
    <table cellspacing="0">
        <thead>
        <tr>
            <?php if ($ShowWeeks): ?>
            <th></th>
            <?php endif; ?>
            <?php foreach ($days as $day): ?>
            <th><?php echo $day;?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $numOfDays = cal_days_in_month(CAL_GREGORIAN, date('n', $time), date('Y', $time));
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
            if ($navigation && $this->PermissionValidation->actionAllowed($PluginId,'CreateEvent')) {
                echo ' ' . $this->Html->link($this->Html->image('add.png', array('width' => 12, 'height' => 12)), array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'add', date('Y-m-d', $time)), array('escape' => false, 'class' => 'calendar_add_entry'));
            }
            echo '</div>';
            echo '<div class="' . $ClassPrefix . 'calendar_content">';
            if ($ShowEntries && array_key_exists($day, $Entries)) {
                foreach ($Entries[$day] as $entry) {
                    echo '<div class="' . $ClassPrefix . 'calendar_entry">';
                    echo $entry['name'];
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
        }
        ?>
        </tbody>
    </table>
</div>