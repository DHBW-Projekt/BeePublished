<div id="foodMenuHeader">
<?php
 $this->Js->set('webroot', $webroot);
 $this->Html->script('/food_menu/js/datepicker', false);
 if($selectedDate != '') {
 	$date = $selectedDate;
 } else $date = (__('mm/dd/yyyy'));
 echo '<h1 style="align:left;">'.__('Bill of Fare').'</h1>';
 echo $this->Form->create('selectdate', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'selectDate')));
 if(isset($url) && $url != '') {
 	 echo $this->Form->hidden('refererurl', array('value' => $url, 'name' => 'data[refererurl]'));
 }
 echo '<p>';
 echo $this->Html->link((__('today')), '#', array('onClick' => 'setToday()', 'id' => 'today'));
 echo '   <input id="datepicker" value="' . $date . '" name="data[datepicker]" type="text" size="10"/>   ';     
 echo $this->Html->link((__('tomorrow')), '#', array('onClick' => 'setTomorrow()', 'id' => 'tomorrow'));
 echo $this->Form->button((__('Select date')), array('type' => 'submit', 'id' => 'selectDate'));
 //echo $this->Html->scriptBlock('$(function() {$( "#datepicker" ).datepicker( {  showOn: "button", buttonImage: window.app.webroot+"calendar.png", buttonImageOnly: true, showOptions: {direction: \'down\'}} );});', array('inline'=>'true'));
 echo $this->Form->end();
 echo '</p>';
 ?>          
</div>