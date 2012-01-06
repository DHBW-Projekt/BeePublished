<div id="adminCategory">
<div id="adminCategoryOverview" style="display:block;">
<?php 
echo $this->Form->create('FoodMenuCategory');
echo $this->Form->button('Neue Kategorie', array('type' => 'button', 'onClick' => 'showDiv(\'adminCategoryEdit\', \'adminCategoryOverview\')'));
echo $this->Form->button('Auswahl löschen');
?>
<table>
<colgroup>
<col width="10px"/>
<col width="200px"/>
<col width="20px"/>
<col width="20px"/>
<col width="20px"/>
</colgroup>
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
//		if(array_key_exists('FoodMenuCategory', $data)) {
//			$menuItems = $data['FoodMenuCategory'];
//		}
foreach ($categories as $category) {
	if ( $category['FoodMenuCategory']['deleted'] != NULL ) continue;
	else {
	echo '<tr>';
	echo '<td>'.$this->Form->checkbox($category['FoodMenuCategory']['id'], array('value' => 1, 'checked' => false, 'hiddenField' => false)).'</td>';
	echo '<td>'.$category['FoodMenuCategory']['name'].'</td>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/Add.png', array('align' => 'left', 'style' => 'float: left', 'width' => '20px', 'alt' => '[+]Add', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'addEntries', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/edit.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[e]Edit', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'editCategory', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
	echo '</td><td>';
	echo $this->Html->image('/app/webroot/img/delete.png', array('style' => 'float: left', 'width' => '20px', 'alt' => '[x]Delete', 'url' => array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'deleteCategory', $category['FoodMenuCategory']['name'], $category['FoodMenuCategory']['id'])));
	echo '</td>';
    echo '</tr>';
	}
}
}
?>
</table>
<?php echo $this->Form->end(); ?>
</div>
<div id="adminCategoryEdit" style="display:none;">
<?php echo $this->element('CreateCategory');?>
</div>
</div>