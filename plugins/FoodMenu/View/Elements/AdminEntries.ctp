<div id="adminEntry">
	<div id="adminEntryOverview" style="display:block;">
	<?php 
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteEntries')));
		echo $this->Form->button('Neuer Eintrag', array('type' => 'button', 'onClick' => 'showDiv(\'adminEntryEdit\', \'adminEntryOverview\')'));
		echo $this->Form->button('Auswahl löschen', array('type' => 'submit'));
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
	if (isset($entries)) {
	//		if(array_key_exists('FoodMenuEntry', $data)) {
	//			$menuItems = $data['FoodMenuEntry'];
	//		}
	foreach ($entries as $entry) {
		if ( $entry['FoodMenuEntry']['deleted'] != NULL ) continue;
		else {
		echo '<tr>';
		echo '<td>'.$this->Form->checkbox($entry['FoodMenuEntry']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['name'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['price'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['currency'].'</td>';
		echo '<td>';
		echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'editEntry', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td><td>';
		echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteEntry', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td>';
	    echo '</tr>';
		}
	}
	}
	?>
	</table>
	<?php echo $this->Form->end(); ?>
	</div>
	<div id="adminEntryEdit" style="display:none;">
	<?php echo $this->element('CreateEntry');?>
	</div>
</div>