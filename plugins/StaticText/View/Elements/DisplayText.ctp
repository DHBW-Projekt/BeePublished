<!-- displays the loaded data -->
<?php
	$this->Html->css('/StaticText/css/template',null,array('inline' => false));
	$this->Helpers->load('BBCode');
?>

<div class="staticText_show">
<?php
	echo $this->BBCode->transformBBCode($data);
?>
</div>