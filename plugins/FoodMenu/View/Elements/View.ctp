<div id="foodMenuMain" style="width:100%; height:450px">
<?php 
	echo $this->element('SelectDate');
	echo $this->element('MenuLinks');
	
	//echo '<h1>'.$foodmenu['Speiseplan'].'</h1>';
	//echo '<h2>'.$category['Kategorie'].'</h2>';
	echo $this->element('Content');
?>
</div>