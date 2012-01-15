<div id="foodMenuHeader">
<?php
 $this->Js->set('webroot', $webroot);
 echo '<h1 style="align:left;">'.__('Bill of Fare').'</h1>';
 echo $this->Form->create('selectdate', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'selectDate')));
 if(isset($url) && $url != '') {
 	 echo $this->Form->hidden('refererurl', array('value' => $url));
 }
 echo '<p>';
 echo $this->Html->link((__('today')), '#', array('onClick' => 'setToday()', 'id' => 'today'));
 echo '   <input id="datepicker" value="' . (__('mm-dd-yyyy')) . '" onchange="document.forms[\'selectdateSelectDateForm\'].submit()" type="text" size="10"/>   ';     
 echo $this->Html->link((__('tomorrow')), '#', array('onClick' => 'setTomorrow()', 'id' => 'tomorrow'));
 echo $this->Form->button((__('Select date')), array('type' => 'submit', 'id' => 'selectDate'));
 echo '</p>';
 echo $this->Html->scriptBlock('$(function() {$( "#datepicker" ).datepicker( {showOn: "button", buttonImageOnly: true, buttonImage: window.app.webroot+"img/calendar.png"} );});',array('inline'=>'true'));
 echo $this->Form->end();
 ?>          
</div>