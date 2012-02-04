<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Benedikt Steffan
 * 
 * @description View for menu in Date-Selection
 */
	 echo '<div id="foodMenuHeader">';
	$this->Js->set('webroot', $webroot);
	$this->Html->css('/food_menu/css/jquery-ui-1.8.16.custom', NULL, array('inline' => false));
	$this->Html->script('/food_menu/js/datepicker', false);
	
	//check if a date was selected earlier an put it to the datepicker-field
	if($selectedDate != '') {
		$date = $selectedDate;
	} else $date = (__d('food_menu', 'mm/dd/yyyy'));
	
	echo '<h1>'.__d('food_menu', 'Bill of Fare').'</h1>';
	echo $this->Form->create('selectdate', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'selectDate')));
	
	//put the current url to a hidden-field to post it to the controller method
	if(isset($url) && $url != '') {
		 echo $this->Form->hidden('refererurl', array('value' => $url, 'name' => 'data[refererurl]'));
	}
	echo '<p>';
	echo $this->Html->link((__d('food_menu', 'Today')), '#', array('onClick' => 'setToday()', 'id' => 'today')).' ';
	echo $this->Html->link((__d('food_menu', 'Tomorrow')), '#', array('onClick' => 'setTomorrow()', 'id' => 'tomorrow')).' ';
	echo '   <input id="datepicker" value="' . $date . '" name="data[datepicker]" type="text" size="10"/>';     
	
	echo $this->Form->button((__d('food_menu', 'Show')), array('type' => 'submit', 'id' => 'selectDate'));
	echo $this->Form->end();
	echo '</p>';
 ?>          
</div>