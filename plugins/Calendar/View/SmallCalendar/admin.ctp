<?php
echo $this->Form->create('null');
echo $this->Form->input('FirstDayOfWeek',array('type' => 'select', 'label' => __('First day of the week'), 'options' => array(
    '1' => 'Monday',
    '2' => 'Tuesday',
    '3' => 'Wednesday',
    '4' => 'Thursday',
    '5' => 'Friday',
    '6' => 'Saturday',
    '7' => 'Sunday'
)));
echo $this->Form->input('ShowWeeks',array('type' => 'checkbox', 'label' => __('Show week number')));
echo $this->Form->input('MonthsBackwards',array('type' => 'select', 'label' => __('Months backwards'), 'options' => array('0','1','2','3','4','5','6','7','8','9','10')));
echo $this->Form->input('MonthsForward',array('type' => 'select', 'label' => __('Months forward'), 'options' => array('0','1','2','3','4','5','6','7','8','9','10')));
echo $this->Form->end(__('save'));
?>