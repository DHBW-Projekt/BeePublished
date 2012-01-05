<div id="foodMenuHeader" style="width:100%; height:50px">
<?php
 //echo $this->Html->script('datepicker');
 //echo $this->Form->create();
 echo $this->Form->button('today', array('update' => '#datepicker', 'id' => 'today'));
 echo $this->Form->button('tomorrow', array('update' => '#datepicker', 'id' => 'tomorrow'));
 echo 'Date: <input id="datepicker" type="text" size="15"/>';
 //echo $this->Form->end();        

echo $this->Html->scriptBlock('$(function() {$( "#datepicker" ).datepicker();});',array('inline'=>'true'));
 ?>          
</div>