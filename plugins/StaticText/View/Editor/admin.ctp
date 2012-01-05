<h1>Set Text</h1>
<?php
	//$this->Html->css('/newsblog/css/editNews', null, array('inline' => false));
	$this->Html->script('/StaticText/js/editText', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->script('/ckeditor/jquery', false); 
	echo $this->Form->create('ContentValues');
?>
<textarea id="editTextEditor" name="editTextEditor"><?php echo  $contentValue['ContentValues']['value'];?> </textarea>
<?php
	echo $this->Form->end('Set Text');
?>
<script type='text/javascript'>
  	var ck_textContent = CKEDITOR.replace( 'editTextEditor' );  
</script>
  