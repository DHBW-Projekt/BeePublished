<?php
echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addEntry')));
echo '<table>';
echo '<tr>';
echo '<td>';
echo $this->Form->input('name').'<br />';
echo $this->Form->textarea('description').'<br />';
echo $this->Form->input('price').'<br />';
echo $this->Form->input('currency').'<br />';
echo '</td></tr>';
echo '</table>';
echo $this->Form->end('Speichern');
?>