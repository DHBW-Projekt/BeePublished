<div style="float:none; width:100%">
<?php
	$this->Html->script('jquery.quicksearch', false);
	$this->Html->script('/food_menu/js/foodmenu', false);
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuMenu', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'deleteMultiple')));
	echo '<div width="100%" id="buttonlink" class="buttonlink">';
	echo '<ul class="buttonlink">';
	echo '<li>'.$this->Html->link((__('New Menu')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'create'), array('class' => 'buttonlink')).'</li>';  	  
	echo '</ul>';
	echo '<form>Search menu: <input type="text" id="search" /> </form>';
	echo '</div>';
	?>
</div>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th>Name</th>
		<th>Gültig von</th>
		<th>Gültig bis</th>
		<th> </th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (isset($menus)) {
		foreach ($menus as $menuEntry) {
			if ( $menuEntry['FoodMenuMenu']['deleted'] != NULL ) continue;
			else {
			echo '<tr>';
			echo '<td  class="tableicon">'.$this->Form->checkbox($menuEntry['FoodMenuMenu']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['name'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_from'].'</td>';
			echo '<td>'.$menuEntry['FoodMenuMenu']['valid_until'].'</td>';
			echo '<td class="tableicon">';
			echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'edit', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
			echo '</td><td class="tableicon">';
			echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'delete', $menuEntry['FoodMenuMenu']['name'], $menuEntry['FoodMenuMenu']['id'])));
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
		echo '</ul>';echo $this->Form->end(); ?>