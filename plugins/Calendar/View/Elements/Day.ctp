<?php
$date = date('Y-m-d', $StartTime);
?>
<div class="calendar">
    <div class="calendar_day_head">
        <div class="calendar_day_name">
            <div class="calendar_day_number">
                <?php echo date('d', $StartTime);?>
            </div>
            <div class="calendar_month_year">
                <?php echo date('D, M Y', $StartTime);?>
                <div class="calendar_day_navigation">
                    <?php echo $this->Html->link('<< ' . date('d.m.', strtotime('-1 days', $StartTime)), $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('-1 days', $StartTime)));?>
                    <?php echo $this->Html->link(date('d.m.', strtotime('+1 days', $StartTime)) . ' >>', $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('+1 days', $StartTime)));?>
                </div>
            </div>
        </div>
        <div class="calendar_month_overview">
            <?php echo $this->element('CalendarFactory', array(
            'ClassPrefix' => '',
            'FDOW' => $FDOW,
            'ShowWeeks' => false,
            'time' => strtotime(date('Y-m', $StartTime)),
            'ClassPrefix' => 'small_',
            'url' => $URL,
            'navigation' => false,
            'Entries' => $MonthEntries,
            'ShowEntries' => false
        ), array('plugin' => 'Calendar'));?>
        </div>
    </div>
    <div class="calendar_day_content">
        <?php
        echo '<div class="calendar_entries">';
        if (array_key_exists($date, $Entries)) {
            $entries = $Entries[$date];
            foreach ($entries as $entry) {
                if ($entry['notime']) {
                    $notimeClass = ' notime';
                } else {
                    $notimeClass = '';
                }
                echo '<div class="calendar_entry' . $notimeClass . '">';
                echo '<div class="calendar_entry_content">' . $this->Html->link($entry['name'], $URL . 'largecalendar/detail/' . $entry['id']) . '</div>';
                echo '<div class="calendar_entry_time_start">';
                if (!$entry['notime']) {
                    echo substr($entry['start_time'], 0, 5) . ' - ' . substr($entry['end_time'], 0, 5);
                } else {
                    echo __('all day event');
                }
                echo '</div>';
                echo '</div>';
            }
        }
        echo $this->Html->link($this->Html->image('add.png', array('width' => 18, 'height' => 18)) . ' Add Entry', array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'add', $date), array('escape' => false, 'class' => 'calendar_add_entry'));
        echo '</div>';
        ?>
    </div>
</div>