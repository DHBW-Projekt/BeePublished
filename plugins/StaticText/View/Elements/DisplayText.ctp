<!-- displays the loaded data -->
<?php
	App::uses('Sanitize', 'Utility');
	$this->Html->css('/StaticText/css/template',null,array('inline' => false));
	$this->Helpers->load('BBCode');
?>

<div class="staticText_show">
<?php
	echo $this->BBCode->transformBBCode(Sanitize::html($data));
?>
</div>