<div class="calendar">
    <div class="calendar_head">
        <div
            class="month_minus"><?php echo $this->Html->link('<< KW ' . date('W', strtotime('-1 weeks', $StartTime)), $URL . 'largecalendar/week/' . date('Y-\WW', strtotime('-1 weeks', $StartTime)));?></div>
        <div
            class="month_plus"><?php echo $this->Html->link('KW '.date('W', strtotime('+1 weeks', $StartTime)) . ' >>', $URL . 'largecalendar/week/' . date('Y-\WW', strtotime('+1 weeks', $StartTime)));?></div>
        <div class="calendar_name">Calendar
            Week <?php echo date('W: d M Y', $StartTime) . ' - ' . date('d M Y', strtotime('+1 week -1 day', $StartTime));?></div>
    </div>
</div>