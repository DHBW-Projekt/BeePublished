<form>
<table style="width:90%; align:center; border: 0px solid black">
<?php
	if (isset($data)) {
		foreach ($data as $entry){
			echo '<tr>';
			echo '<td>'.echo $this->Form->checkbox($entry['Entry']['ID'], array('hiddenField' => false)).'</td>';
			echo '<td>'.$entry['Entry']['name'].'</td>';
			echo '<td>'.$entry['Entry']['price'].' '.$entry['Entry']['currency'].'</td>';
			// Icons mit Funktionen einfügen
			echo '<td></td>';
			echo '</tr>';
		}
	}
?>
</table>
</form>