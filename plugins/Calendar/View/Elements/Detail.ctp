<?php
App::uses('Sanitize', 'Utility');
$this->Helpers->load('BBCode');
?>
<div class="calendar_day_head">
    <div class="calendar_day_name">
        <div class="calendar_day_number">
            <?php echo date('d', strtotime($Entry['start_date']));?>
        </div>
        <div class="calendar_month_year">
            <?php
            echo date('D, M Y', strtotime($Entry['start_date']));
            if (!$Entry['notime']) {
                echo '<br/>';
                echo substr($Entry['start_time'], 0, 5) . ' - ' . substr($Entry['end_time'], 0, 5);
            }
            ?>
        </div>
    </div>
    <div class="calendar_month_overview">
        <h1><?php echo Sanitize::html($Entry['name']); ?>
            <?php
            if ($this->PermissionValidation->actionAllowed($PluginId, 'CreateEvent')) {
                echo $this->Html->link($this->Html->image('edit.png', array('width' => 15, 'height' => 15)), array('plugin' => 'Calendar', 'controller' => 'CalendarEntries', 'action' => 'edit', $Entry['id']), array('escape' => false, 'class' => 'calendar_add_entry'));
            }
            ?>
        </h1>
    </div>
</div>
<div style="clear:both"></div>
<br/>
<hr/>
<br/>
<?php echo $this->BBCode->transformBBCode(Sanitize::html($Entry['description'])); ?>