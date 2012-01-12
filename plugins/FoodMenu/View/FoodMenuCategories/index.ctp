<?php
	echo $this->element('admin_menu');
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'deleteMultiple')));
	
	echo '<div id="buttonlink" class="buttonlink">';
	echo '<ul class="buttonlink">';
	echo '<li class="buttonlink">'.$this->Html->link((__('New Category')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create'), array('class' => 'buttonlink')).'</li>
		  <li class="buttonlink">'.$this->Html->link((__('Delete Selection')), '#', array('onClick' => 'confirmDelete();', 'class' => 'buttonlink')).'</li>';
	echo '</ul><br />';
	echo '</div>';
	?>
	<table>
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
	if (isset($categories)) {
		foreach ($categories as $category) {
			if ( $category['FoodMenuCategory']['deleted'] != NULL ) continue;
			else {
				echo '<tr>';
				echo '<td>'.$this->Form->checkbox($category['FoodMenuCategory']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
				echo '<td>'.$category['FoodMenuCategory']['name'].'</td>';
				echo '<td>';
				echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'edit', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				echo '</td><td>';
				echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'delete', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				echo '</td>';
			    echo '</tr>';
			}//else
		}//foreach
	}//if
	?>
	</table>
	<?php echo $this->Form->end(); ?>
</div>