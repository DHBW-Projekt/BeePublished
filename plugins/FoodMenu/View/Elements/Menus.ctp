<form>
<table style="width:90%; align:center; border: 0px solid black">
<?php
	if (isset($data)) {
		foreach ($data as $menu){
			echo '<tr>';
			echo '<td>'.echo $this->Form->checkbox($menu['Menu']['ID'], array('hiddenField' => false)).'</td>';
			echo '<td>'.$menu['Menu']['name'].'</td>';
			echo '<td>'.$menu['Menu']['valid_to'].'</td>';
			// auf readOnly setzen und abfragen ob es eine Setie ist
			echo '<td>'.echo $this->Form->checkbox($menu['Menu']['ID'], array('hiddenField' => false)).</td>';
			// Icons mit Funktionen einfügen
			echo '<td></td>';
			echo '</tr>';
		}
	}
?>
</table>
</form>