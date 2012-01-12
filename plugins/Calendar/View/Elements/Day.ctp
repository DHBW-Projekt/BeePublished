<div class="calendar">
    <div class="calendar_head">
        <div
            class="month_minus"><?php echo $this->Html->link('<< ' . date('d.m.Y', strtotime('-1 days', $StartTime)), $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('-1 days', $StartTime)));?></div>
        <div
            class="month_plus"><?php echo $this->Html->link(date('d.m.Y', strtotime('+1 days', $StartTime)) . ' >>', $URL . 'largecalendar/day/' . date('Y-m-d', strtotime('+1 days', $StartTime)));?></div>
        <div class="calendar_name"><?php echo date('d M Y', $StartTime);?></div>
    </div>
</div>