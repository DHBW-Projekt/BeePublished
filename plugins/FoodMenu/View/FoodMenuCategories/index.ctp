<?php
	$this->Html->script('jquery.quicksearch', false);
	$this->Html->script('/food_menu/js/foodmenu', false);
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'deleteMultiple')));
	
	echo '<div id="buttonlink" class="buttonlink">';
	echo '<ul class="buttonlink">';
	echo '<li class="buttonlink">'.$this->Html->link((__('New Category')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create'), array('class' => 'buttonlink')).'</li>';
	echo '</ul>';
	echo '<form>Search category: <input type="text" id="search" /> </form>';
	echo '</div>';
	?>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th>Name</th>
		<th> </th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (isset($categories)) {
		foreach ($categories as $category) {
			if ( $category['FoodMenuCategory']['deleted'] != NULL ) continue;
			else {
				echo '<tr>';
				echo '<td class="tableicon">'.$this->Form->checkbox($category['FoodMenuCategory']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
				echo '<td>'.$category['FoodMenuCategory']['name'].'</td>';
				echo '<td class="tableicon">';
				echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'edit', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				echo '</td><td class="tableicon">';
				echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'delete', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				echo '</td>';
			    echo '</tr>';
			}//else
		}//foreach
	}//if
	?>
	</tbody>
	</table>
	<br />
		<?php 
		echo '<ul class="buttonlink">';
		echo '<li class="buttonlink">'.$this->Html->link((__('Delete Selection')), '#', array('onClick' => 'confirmDelete();', 'class' => 'buttonlink')).'</li>';
		echo '</ul>';
		echo $this->Form->end(); ?>