<?php echo $this->Html->script('/app/jquery-1.6.2.min');?>
<?php echo $this->Html->script('/app/jquery-ui-1.8.16.custom.min');?>
<div id="foodMenuMain" style="width:100%; height:450px">
<?php 
	echo $this->element('SelectDate');
	//echo $this->element('MenuLinks');
?>
<div id="foodMenuMenu" style="width:100%; height:30px">
<ul>
<?php
	if (isset($data)) {
		if(array_key_exists('FoodMenuMenu', $data)) {
			$menuItems = $data['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
			$menu = $dataItem;
			echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showCatergories', $menu['FoodMenuMenu']['name']), array()).'</li>'; //$menu['FoodMenuMenu']['name']).' ';	
			}
		}
		echo '</ul><br />';	
		
		
		if(array_key_exists('FoodMenuCategory', $data)) {
			echo '<ul>';
			$categoryItems = $data['FoodMenuCategory'];
			foreach ($categoryItems as $dataItem){
			$menu = $dataItem;
			echo '<li>'.$this->Html->link($menu['FoodMenuCategory']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $menu['FoodMenuCategory']['name']), array()).'</li>'; //$menu['FoodMenuMenu']['name']).' ';					
			}
		}	
		if(array_key_exists('FoodMenuEntry', $data)) {
			$entryItems = $data['FoodMenuEntry'];
		}		
		

					
		

	}
?>
</ul>
</div>
</div>