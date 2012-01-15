<div id="adminEntryOverview">
	<?php 
		$this->Html->script('jquery.quicksearch', false);
		$this->Html->script('/food_menu/js/foodmenu', false);
		echo $this->element('admin_menu');
		echo $this->Form->create('FoodMenuEntry', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'deleteMultiple')));
		echo '<div id="buttonlink" class="buttonlink">';
		echo '<ul class="buttonlink">';
		echo '<li class="buttonlink">'.$this->Html->link((__('New Entry')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'create'), array('class' => 'buttonlink')).'</li>';
		echo '</ul>';
		echo '<form>Search entry: <input type="text" id="search" /> </form>';
		echo '</div>';
		?>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th>Name</th>
		<th>Preis</th>
		<th>Währung</th>
		<th> </th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (isset($entries)) {
	foreach ($entries as $entry) {
		if ( $entry['FoodMenuEntry']['deleted'] != NULL ) continue;
		else {
		echo '<tr>';
		echo '<td  class="tableicon">'.$this->Form->checkbox($entry['FoodMenuEntry']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['name'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['price'].'</td>';
		echo '<td>'.$entry['FoodMenuEntry']['currency'].'</td>';
		echo '<td class="tableicon">';
		echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'edit', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td><td class="tableicon">';
		echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'delete', $entry['FoodMenuEntry']['name'], $entry['FoodMenuEntry']['id'])));
		echo '</td>';
	    echo '</tr>';
		}
	}
	}
	?>
	</tbody>
	</table>
	<br />
	<?php 
		echo '<ul class="buttonlink">';
		echo '<li class="buttonlink">'.$this->Html->link((__('Delete Selection')), '#', array('onClick' => 'confirmDelete();', 'class' => 'buttonlink')).'</li>';
		echo '</ul>';
		echo $this->Form->end(); ?>
</div>