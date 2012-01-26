<div>
<?php 
	$this->Helpers->load('BBCode');
	$text = $this->BBCode->transformBBCode($data);
	echo $text;
?>
</div>