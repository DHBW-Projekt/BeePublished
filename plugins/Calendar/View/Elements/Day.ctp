<div class="calendar">
<div class="calendar_head">
<div class="month_minus"><?php echo $this->Html->link('<< ' . date('d.m.Y', strtotime('-1 days', $StartTime)), $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('-1 days', $StartTime)));?></div>
<div class="month_plus"><?php echo $this->Html->link(date('d.m.Y', strtotime('+1 days', $StartTime)) . ' >>', $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('+1 days', $StartTime)));?></div>
<div class="calendar_name"><?php echo date('d M Y', $StartTime);?></div>
<?php
$date = date('Y-m-d', $StartTime);
echo $this->Html->link($this->Html->image('add.png', array('width' => 18, 'height' => 18)) . ' Add Entry', array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'add', $date), array('escape' => false, 'class' => 'calendar_add_entry'));
if (array_key_exists($date, $Entries)) {
	$entries = $Entries[$date];
	foreach ($entries as $entry) {
		if ($entry['notime']) {
			$notimeClass = ' notime';
		} else {
			$notimeClass = '';
		}
		echo '<div class="calendar_entry' . $notimeClass . '">';
		if (!$entry['notime']) {
			echo '<div class="calendar_entry_time_start">';
			echo substr($entry['start_time'], 0, 5);
			echo '</div>';
		}
		echo '<div class="calendar_entry_content">' . $entry['name'] . '</div>';
		echo '</div>';
	}
}
?></div>
</div>
