<div id="foodMenuHeader" style="padding: 10px; width:100%;">
<?php
 echo '<p>'.__('Bitte wählen Sie einen Tag aus:').'</p>';
 echo $this->Form->button('today', array('update' => '#datepicker', 'id' => 'today'));
 echo $this->Form->button('tomorrow', array('update' => '#datepicker', 'id' => 'tomorrow'));
 echo 'Date: <input id="datepicker" type="text" size="15"/>';     

 echo $this->Html->scriptBlock('$(function() {$( "#datepicker" ).datepicker();});',array('inline'=>'true'));
 ?>          
</div>