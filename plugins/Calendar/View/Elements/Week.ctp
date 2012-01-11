<div class="calendar">
    <div class="calendar_head">
        <div class="calendar_name">Calendar Week <?php echo date('W: d M Y', $StartTime) . ' - ' . date('d M Y',strtotime('+1 week -1 day',$StartTime));?></div>
    </div>
</div>