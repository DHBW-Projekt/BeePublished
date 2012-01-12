<div id="adminAddCategoryToMenu" style="display:none;"></div>
<?php
	echo $this->Form->create('FoodMenuCategory', array('url' => array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'addCategoriesToMenu')));
	echo $this->Form->hidden('id', array('value' => $menu['FoodMenuMenu']['id']));
?>
<table>
	<colgroup>
		<col width="10px"/>
		<col width="200px"/>
	</colgroup>
	<thead>
	<tr>
		<th> </th>
		<th>Name</th>
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
			    echo '</tr>';
			}//else
		}//foreach
	}//if
	?>
</table>
<?php
echo $this->Form->button(__('Speichern'), array('type' => 'submit'));
	echo $this->Form->button(__('Zurück'), array('type' => 'button', 'onClick' => 'showDiv(\'adminMenuOverview\', \'adminAddCategoryToMenu\')'));
echo $this->Form->end();
?>
</div>