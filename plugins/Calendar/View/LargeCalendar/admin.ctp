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
echo $this->Form->end(__('save'));
?>