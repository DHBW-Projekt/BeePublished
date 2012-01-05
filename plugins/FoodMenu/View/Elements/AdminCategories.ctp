<div id="adminCategory">
<?php 
echo $this->Form->create('FoodMenuCategory');
echo $this->Form->button('Neue Kategorie');
echo $this->Form->button('Auswahl löschen');
?>
<table>
<colgroup>
<col width="10px"/>
<col width="200px"/>
<col width="20px"/>
<col width="20px"/>
<col width="20px"/>
</colgroup>
<thead>
<tr>
<th> </th>
<th>Name</th>
<th> </th>
<th> </th>
<th> </th>
</tr>
</thead>
<?php
if (isset($data)) {
		if(array_key_exists('FoodMenuCategory', $data)) {
			$menuItems = $data['FoodMenuCategory'];
		}
foreach ($menuItems as $menuEntry) {
	if ( $menuEntry['FoodMenuCategory']['deleted'] != NULL ) continue;
	else {
	echo '<tr>';
	echo '<td>'.$this->Form->checkbox($menuEntry['FoodMenuCategory']['ID'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
	echo '<td>'.$menuEntry['FoodMenuCategory']['name'].'</td>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/Add.png', array('align' => 'left', 'style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addEntries', $menuEntry['FoodMenuCategory']['name'], $menuEntry['FoodMenuCategory']['ID'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'editCategory', $menuEntry['FoodMenuCategory']['name'], $menuEntry['FoodMenuCategory']['ID'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteCategory', $menuEntry['FoodMenuCategory']['name'], $menuEntry['FoodMenuCategory']['ID'])));
	echo '</td>';
    echo '</tr>';
	}
}
}
?>
</table>
<?php echo $this->Form->end(); ?>
</div>