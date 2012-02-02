<?php
echo $this->Form->create('null');
echo $this->Form->input('FirstDayOfWeek',array('type' => 'select', 'label' => __d('calendar','First day of the week'), 'options' => array(
    '1' => 'Monday',
    '7' => 'Sunday'
)));
echo $this->Form->input('ShowWeeks',array('type' => 'checkbox', 'label' => __d('calendar','Show week number')));
echo $this->Form->input('MonthsBackwards',array('type' => 'select', 'label' => __d('calendar','Months backwards'), 'options' => array('0','1','2','3','4','5','6','7','8','9','10')));
echo $this->Form->input('MonthsForward',array('type' => 'select', 'label' => __d('calendar','Months forward'), 'options' => array('0','1','2','3','4','5','6','7','8','9','10')));
echo $this->Form->end(__d('calendar','Save'));
?>