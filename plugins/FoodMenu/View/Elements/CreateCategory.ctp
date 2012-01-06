<?php
echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addCategory')));
echo '<table>';
echo '<tr>';
echo '<td>';
echo $this->Form->input('name').'<br />';
echo '</td></tr>';
echo '</table>';
echo $this->Form->button(__('Speichern'), array('type' => 'submit', 'onClick' => 'showDiv(\'adminCategoryOverview\', \'adminCategoryEdit\')'));
echo $this->Form->button(__('Zurück'), array('type' => 'button', 'onClick' => 'showDiv(\'adminCategoryOverview\', \'adminCategoryEdit\')'));
echo $this->Form->end();
?>