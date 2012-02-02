<?php
echo $this->Form->create('null');
echo $this->Form->input('FirstDayOfWeek',array('type' => 'select', 'label' => __d('calendar','First day of the week'), 'options' => array(
    '1' => 'Monday',
    '7' => 'Sunday'
)));
echo $this->Form->input('ShowWeeks',array('type' => 'checkbox', 'label' => __d('calendar', 'Show week number')));
echo $this->Form->end(__d('calendar','Save'));
?>