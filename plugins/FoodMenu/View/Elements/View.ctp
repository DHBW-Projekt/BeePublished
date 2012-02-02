<?php 
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Benedikt Steffan
 * 
 * @description View for user view
 */
    $this->Html->css('/food_menu/css/menu', NULL, array('inline' => false)); 
?>
<?php 
	$user = $this->Session->read('Auth.User');
?>
<div id="foodMenuMain">
<?php
	echo $this->Session->flash();
	if(!(isset($url))) $url = '';
	//call the dateSelection Element
	echo $this->element('SelectDate', array('url' => $url, 'selectedDate' => $selectedDate));
	
	if(!(isset($categories))) $categories = '';
	if(!(isset($entries))) $entries = '';
	
	/* initial call, $data is set by component */
	if (isset($data['show'])) {
		//Show the FoodMenus in the navigation menu
		if(array_key_exists('FoodMenuMenu', $data['show'])) {
			
			if (array_key_exists('SelectedMenu', $data['show'])) {
				$selectedMenuId = $data['show']['SelectedMenu']['id'];
			} else {$selectedMenuId = -1;}
			echo '<div id="foodMenuMenu">';
			echo '<ul class="FoodMenuMenu">';
			$menuItems = $data['show']['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
				//don't show deleted data
				if ( $dataItem['deleted'] != NULL ) continue;
				else {
					$menu = $dataItem;
					if ($menu['id'] == $selectedMenuId) {
						//highlight the selected FoodMenu
						echo '<li><strong>'.$this->Html->link($menu['name'], $url . '/view/menu/' .  $menu['name'] . '/' . $menu['id'] . '/' . $selectedDate).'</strong></li>';	;
					} else {
						echo '<li>'.$this->Html->link($menu['name'], $url . '/view/menu/' .  $menu['name'] . '/' . $menu['id'] . '/' . $selectedDate).'</li>';	
					}
				}//else
			}//foreach
			echo '</ul>';
			echo '</div>';			
		}//if
		
		//Show Categories in Menu
		if(array_key_exists('FoodMenuCategory', $data['show']) && isset($data['show']['FoodMenuCategory'][0])) {
			echo '<div id="foodMenuCategory">';
				if (array_key_exists('SelectedCategory', $data['show'])) {
					$selectedCategoryId = $data['show']['SelectedCategory']['id'];
				} else { $selectedCategoryId = -1; }
				echo '<ul class="FoodMenuMenu">';
				$categoryItems = $data['show']['FoodMenuCategory'];
				foreach ($categoryItems as $dataItem){
					//don't show deleted data
					if ( $dataItem['deleted'] != NULL ) continue;
					else {
						$category = $dataItem;
						if ($category['id'] == $selectedCategoryId) {
							//highlight the selected category
							echo '<li><strong>'.$this->Html->link($category['name'], $url . '/view/menu/' . $data['show']['SelectedMenu']['name'] . '/' . $data['show']['SelectedMenu']['id'] . '/category/' .  $category['name'] . '/' . $category['id'] . '/' . $selectedDate).'</strong></li>';	
						} else {
							echo '<li>'.$this->Html->link($category['name'], $url . '/view/menu/' . $data['show']['SelectedMenu']['name'] . '/' . $data['show']['SelectedMenu']['id'] . '/category/' .  $category['name'] . '/' . $category['id'] . '/' . $selectedDate).'</li>';
						}
					}//else
				}//foreach
				echo '</ul>';
			echo '</div>';
			}//if
			
		//show entries of selected category in a table
		if(array_key_exists('FoodMenuEntry', $data['show'])  && isset($data['show']['FoodMenuEntry'][0])) {
			echo '<div id="foodMenuEntry">';
			if(array_key_exists('SelectedCategory', $data['show'])) {
				?>
				<table id="userMenuEntries" class="viewEntries">
				<thead>
				<tr>
					<th><?php echo $data['show']['SelectedCategory']['name']; ?></th>
					<th><?php echo (__d('food_menu', 'Price')); ?>
				</tr>
				</thead>
				<tbody>
				<?php
				$entryItems = $data['show']['FoodMenuEntry'];
				foreach ($entryItems as $dataItem){
					if ( $dataItem['deleted'] != NULL ) continue;
					else {
						echo '<tr>';
						$entry = $dataItem;
						echo '<td class="entryName">' . $entry['name'] . '</td>';
						echo '<td class="entryPrice">' . $this->Number->currency($entry['price'], $entry['currency']) . '</td>';
						if((isset($entry['description'])) && $entry['description'] != '') {
							echo '</tr><tr>';
							echo '<td colspan="2" class="entryDescription">' . $entry['description'] . '</td>';
						}//if
						echo '</tr>';
					}//else
				}//foreach
				echo '</tbody>';
				echo '</table>';				
			}//if
			
			echo '</div>';

		}//if
	}//if
?>
	
</div>