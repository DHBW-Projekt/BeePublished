<div id="adminMenu">
<?php 
echo $this->Form->create('FoodMenuEntry');
echo $this->Form->button('Neuer Eintrag');
echo $this->Form->button('Auswahl löschen');
?>
<table>
<colgroup>
<col width="10px"/>
<col width="200px"/>
<col width="100px"/>
<col width="100px"/>
<col width="20px"/>
<col width="20px"/>
<col width="20px"/>
</colgroup>
<thead>
<tr>
<th> </th>
<th>Name</th>
<th>Preis</th>
<th>Währung</th>
<th> </th>
<th> </th>
<th> </th>
</tr>
</thead>
<?php
if (isset($data)) {
		if(array_key_exists('FoodMenuEntry', $data)) {
			$menuItems = $data['FoodMenuEntry'];
		}
foreach ($menuItems as $menuEntry) {
	if ( $menuEntry['FoodMenuEntry']['deleted'] != NULL ) continue;
	else {
	echo '<tr>';
	echo '<td>'.$this->Form->checkbox($menuEntry['FoodMenuEntry']['ID'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
	echo '<td>'.$menuEntry['FoodMenuEntry']['name'].'</td>';
	echo '<td>'.$menuEntry['FoodMenuEntry']['price'].'</td>';
	echo '<td>'.$menuEntry['FoodMenuEntry']['currency'].'</td>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'editEntry', $menuEntry['FoodMenuEntry']['name'], $menuEntry['FoodMenuEntry']['ID'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteEntry', $menuEntry['FoodMenuEntry']['name'], $menuEntry['FoodMenuEntry']['ID'])));
	echo '</td>';
    echo '</tr>';
	}
}
}
?>
</table>
<?php echo $this->Form->end(); ?>
</div>