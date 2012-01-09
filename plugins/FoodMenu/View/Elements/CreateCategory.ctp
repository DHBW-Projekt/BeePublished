<?php
if(!(isset($mode))) $mode = '';
if ($mode=='edit') {
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'editCategory')));
}
else {
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'addCategory')));
}
echo $this->Session->flash();
echo '<table>';
echo '<tr>';
echo '<td>';

if (isset($category)) {
	echo $this->Form->hidden('id', array('value' => $category['FoodMenuCategory']['id']));
	echo $this->Form->input('name').'<br />';
	echo '</td></tr>';
}
else {
	echo $this->Form->input('name').'<br />';
	echo '</td></tr>';
}
echo '</table>';
echo $this->Form->button(__('Speichern'), array('type' => 'submit'));
echo $this->Form->button(__('Zurück'), array('type' => 'button', 'onClick' => 'showDiv(\'adminCategoryOverview\', \'adminCategoryEdit\')'));
echo $this->Form->end();
?>