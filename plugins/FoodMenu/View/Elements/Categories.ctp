<form>
<table style="width:90%; align:center; border: 0px solid black">
<?php
	if (isset($data)) {
		foreach ($data as $category){
			echo '<tr>';
			echo '<td>'.$this->Form->checkbox($category['Category']['ID'], array('hiddenField' => false)).'</td>';
			echo '<td>'.$category['Category']['name'].'</td>';
			// Icons mit Funktionen einfügen
			echo '<td></td>';
			echo '</tr>';
		}
	}
?>
</table>
</form>