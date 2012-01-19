<?php
$this->Helpers->load('BBCode');
?>
<div class="calendar_day_head">
    <div class="calendar_day_name">
        <div class="calendar_day_number">
            <?php echo date('d', strtotime($Entry['start_date']));?>
        </div>
        <div class="calendar_month_year">
            <?php echo date('D, M Y', strtotime($Entry['start_date']));?>
        </div>
    </div>
    <div class="calendar_month_overview">
        <h1><?php echo $Entry['name']; ?></h1>
    </div>
</div>
<div style="clear:both"></div>
<br/>
<hr/>
<br/>
<?php echo $this->BBCode->transformBBCode($Entry['name']); ?>