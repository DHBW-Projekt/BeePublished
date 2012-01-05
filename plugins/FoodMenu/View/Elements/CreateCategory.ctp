<?php
echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addCategory')));
echo '<table>';
echo '<tr>';
echo '<td>';
echo $this->Form->input('name').'<br />';
echo '</td></tr>';
echo '</table>';
echo $this->Form->end('Speichern');
?>