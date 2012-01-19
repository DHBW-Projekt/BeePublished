<?php
	$this->Html->script('jquery/jquery.quicksearch', false);
	$this->Html->script('/food_menu/js/foodmenu', false);
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
		
	echo $this->element('admin_menu');
	if($createAllowed){
		echo $this->Form->create('FoodMenuCreateCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'create')));
		echo '<h1>'.(__('Create new category')).'</h1>';
		echo $this->Form->end(__('New Category'));
		echo '<br /><hr /><br />';
	}
	echo '<h1>'.(__('Categories')).'</h1>';
	echo '<form>Search category: <input type="text" id="search" /> </form>';
	echo $this->Form->create('FoodMenuCategory', array(
								'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'deleteMultiple'), 
								'onsubmit' => 'return confirm(\''. __('Do you really want to delete the selected categories?') .'\');'));

	?>
	<table id="tableEntries">
	<thead>
	<tr>
		<th> </th>
		<th><?php echo __('Name'); ?></th>
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
				if($deleteAllowed){
					echo '<td class="tableicon">'.$this->Form->checkbox($category['FoodMenuCategory']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
				}
				else echo '<td class="tableicon"> </td>';
				echo '<td>'.$category['FoodMenuCategory']['name'].'</td>';
				echo '<td class="tableicon">';
				if($editAllowed) {
					echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'edit', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				}
				echo '</td><td class="tableicon">';
				if($deleteAllowed) {
					echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'delete', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
				}
				echo '</td>';
			    echo '</tr>';
			}//else
		}//foreach
	}//if
	?>
	</tbody><?php
	if ($deleteAllowed) { ?>
	<tfoot>
		<tr>
			<td><?php echo $this->Html->image('/app/webroot/img/arrow.png', array('alt' => 'arrow')); ?></td>
			<td colspan="3"><?php echo $this->Form->submit(__('Delete')); ?></td>
		</tr>
	</tfoot><?php
	} ?>
	</table>
	<br />
		<?php 
		echo $this->Form->end(); ?>