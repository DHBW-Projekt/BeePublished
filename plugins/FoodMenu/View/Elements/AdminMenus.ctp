<div id="adminMenu">
<?php 
echo $this->Form->create('FoodMenuMenu');
echo $this->Form->button('Neuer Speiseplan');
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
<th>Gültig von</th>
<th>Gültig bis</th>
<th> </th>
<th> </th>
<th> </th>
</tr>
</thead>
<?php
if (isset($data)) {
		if(array_key_exists('FoodMenuMenu', $data)) {
			$menuItems = $data['FoodMenuMenu'];
		}
foreach ($menuItems as $menuEntry) {
	if ( $menuEntry['FoodMenuMenu']['deleted'] != NULL ) continue;
	else {
	echo '<tr>';
	echo '<td>'.$this->Form->checkbox($menuEntry['FoodMenuMenu']['ID'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
	echo '<td>'.$menuEntry['FoodMenuMenu']['name'].'</td>';
	echo '<td>'.$menuEntry['FoodMenuMenu']['valid_from'].'</td>';
	echo '<td>'.$menuEntry['FoodMenuMenu']['valid_until'].'</td>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/Add.png', array('align' => 'left', 'style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addCategories', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['ID'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'editMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['ID'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['ID'])));
	echo '</td>';
    echo '</tr>';
	}
	}
}
?>
</table>
<?php echo $this->Form->end(); ?>
</div>