<div style="float:none; width:100%">
<?php
    $this->Html->css('/food_menu/css/menu');
	echo $this->element('PluginMenu');
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'deleteMenus')));
	echo '<div>';
	echo '<ul id="buttonlink" class="buttonlink">';
	echo '<li class="buttonlink">'.$this->Html->link((__('New Menu')), array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'addMenu'), array('class' => 'buttonlink')).'</li>
		  <li class="buttonlink">'.$this->Html->link((__('Delete Selection')), '#', array('onClick' => 'document.forms["FoodMenuMenuViewMenusForm"].submit()', 'class' => 'buttonlink')).'</li>';
	echo '</ul><br />';
	echo '</div>';
	?>
</div>
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
			echo $this->Html->image('/app/webroot/img/Add.png', array('align' => 'left', 'style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'addCategoriesToMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td><td>';
			echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'editMenu', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
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