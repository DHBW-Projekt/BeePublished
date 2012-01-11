<div id="foodMenuHeader" style="padding: 10px; width:100%;">
<?php
 echo '<h1 style="align:left;">'.__('Bill of Fare').'</h1>';
 echo '<p>';
 echo $this->Html->link((__('today')), '#', array('onClick' => 'setToday()', 'id' => 'today'));
 echo '   <input id="datepicker" type="text" size="10"/>   ';     
 echo $this->Html->link((__('tomorrow')), '#', array('onClick' => 'setTomorrow()', 'id' => 'tomorrow'));
 echo '</p>';
 echo $this->Html->scriptBlock('$(function() {$( "#datepicker" ).datepicker();});',array('inline'=>'true'));
 ?>          
</div>