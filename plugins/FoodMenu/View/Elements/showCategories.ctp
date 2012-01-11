<?php
debug($menuEntries);
?>
<div id="FoodMenuShowCategories">
	<h2><?php echo $menuName; ?></h2>
	<table>
		<colgroup>
			<col width="5%"/>
			<col width="75%"/>
			<col width="20%"/>
		</colgroup>
	<?php 
		foreach ($menuEntries['FoodMenuCategory'] as $category) {	
					echo '<tr>';
					echo '<td colspan="3" class="category">'.$category['name'].'</td>';
					echo '</tr>';
//					foreach ($menuEntry as $dish) {
//						echo '<tr>';
//						echo '<td class="name">'.$dish['name'].'</td>';
//						echo '<td class="currency">'.$this->Number->currency($dish['price'], $dish['currency']).'</td>';
//						echo '<td></td>';
//						echo '</tr>';
//						echo '<tr>';
//						echo '<td class="description" colspan="3"></td>';
//						echo '</tr>';
//					}//foreach
		}//foreach
	?>
	</table>
</div>
