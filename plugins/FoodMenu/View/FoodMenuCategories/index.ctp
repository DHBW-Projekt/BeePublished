<?php
	$this->Html->script('jquery/jquery.quicksearch', false);
	$this->Html->script('/food_menu/js/foodmenu', false);
	echo $this->element('admin_menu');
	
	echo $this->Form->create('FoodMenuCreateCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
	echo '<h1>'.(__('Create new category')).'</h1>';
	echo $this->Form->end(__('New Category'));
	echo '<hr>';
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'deleteMultiple')));
//	echo '<div id="buttonlink" class="buttonlink">';
	echo '<form>Search category: <input type="text" id="search" /> </form>';
//	echo '</div>';
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
	<tfoot>
		<tr>
			<td><?php echo $this->Html->image('/app/webroot/img/arrow.png', array('alt' => 'arrow')); ?></td>
			<td colspan="3"><?php echo $this->Form->button(__('Delete'), array('onClick' => 'confirmDelete();')); ?></td>
		</tr>
	</tfoot>
	</table>
	<br />
		<?php 
		echo $this->Form->end(); ?>