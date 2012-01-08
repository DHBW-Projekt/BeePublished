<?php
$this->Html->script('/ckeditor/ckeditor',false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/calendar/js/admin',false);
echo $this->Form->create('Calendar.CalendarEntry');
echo $this->Form->input('start_date');
echo $this->Form->input('description');
echo $this->Form->end(__('Save'));
?>