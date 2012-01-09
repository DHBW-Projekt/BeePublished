<div id="adminMenu">
	<?php 
	if ($mode=='edit')
			echo '<div id="adminMenuOverview" style="display:none;">';
	else 
		echo '<div id="adminMenuOverview" style="display:block;">';
	
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'deleteMenus')));
	echo $this->Form->button('Neuer Speiseplan', array('type' => 'button', 'onClick' => 'showDiv(\'adminMenuEdit\', \'adminMenuOverview\')'));
	echo $this->Form->button('Auswahl löschen', array('type' => 'submit'));
	?>
	<table>
	<colgroup>
		<col width="5%"/>
		<col width="40%"/>
		<col width="20%"/>
		<col width="20%"/>
		<col width="5%"/>
		<col width="5%"/>
		<col width="5%"/>
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
	if (isset($menus)) {
		foreach ($menus as $menuEntry) {
			if ( $menuEntry['FoodMenuMenu']['deleted'] != NULL ) continue;
			else {
			echo '<tr>';
			echo '<td>'.$this->Form->checkbox($menuEntry['FoodMenuMenu']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['name'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_from'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_until'].'</td>';
			echo '<td>';
			echo $this->Html->image('/app/webroot/img/Add.png', array('onClick' => 'showDiv(\'adminAddCategoryToMenu\', \'adminMenuOverview\')', 'align' => 'left', 'style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'addCategoriesToMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td><td>';
			echo $this->Html->image('/app/webroot/img/edit.png', array('onClick' => 'showDiv(\'adminMenuEdit\', \'adminMenuOverview\')', 'style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'editMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td><td>';
			echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'deleteMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td>';
		    echo '</tr>';
			}
		}
	}
	?>
	</table>
	<?php echo $this->Form->end(); ?>
	</div>
	<?php
	if ($mode == 'edit')
		echo '<div id="adminMenuEdit" style="display:block;">';
	else {
		echo '<div id="adminMenuEdit" style="display:none;">';
	}
    echo $this->element('CreateMenu');
    ?>
    </div>
</div>