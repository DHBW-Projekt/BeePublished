<?php
$this->Html->script('ckeditor/ckeditor',false);
$this->Html->script('ckeditor/adapters/jquery',false);
$this->Html->script('/calendar/js/admin',false);
echo $this->Form->create('CalendarEntry');
echo $this->Form->input('name');
echo $this->Form->input('notime');
echo $this->Form->input('start_date');
echo $this->Form->input('start_time');
echo $this->Form->input('end_date');
echo $this->Form->input('end_time');
echo $this->Form->input('description');
echo $this->Form->end(__d('calendar','Save'));
?>