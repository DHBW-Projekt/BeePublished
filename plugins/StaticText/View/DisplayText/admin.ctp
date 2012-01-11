<h1>Set Text</h1>
<?php
	//embedding the needed scripts
	echo $this->Html->script('/StaticText/js/editText', false);
	echo $this->Html->script('/ckeditor/ckeditor', false);
	echo $this->Html->script('/ckeditor/adapters/jquery', false);
	echo $this->Html->script("/StaticText/js/StaticText", true);
?>
<div class="texteditor">
	<?php echo $this->Form->create('ContentValues');?><br>
	<div id="tabs">
		<div id="tabs-1">
			<p>
				<!-- is not working,  if the textarea is not html !? -->
				<textarea id="editTextEditor" name="editTextEditor"><?php echo  $contentValue['ContentValues']['value'];?> </textarea>
			</p>
  		</div>
	</div>
</div>
<script type='text/javascript'>
	CKEDITOR.replace('editTextEditor');
</script>
<?php echo $this->Form->end('Set Text');?>