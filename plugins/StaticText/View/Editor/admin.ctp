<h1>Set Text</h1>
<?php
	$this->Html->script('/StaticText/js/editText', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->script('/ckeditor/adapters/jquery', false);
	echo $this->Html->script("/StaticText/js/StaticText", true);
?>
<div class="texteditor">
	<?php echo $this->Form->create('ContentValues');?>
	<div id="tabs">
		<div id="tabs-1">
			<p>
				<!-- is not working,  if the textarea is not html !? -->
				<textarea id="editTextEditor" name="editTextEditor"><?php echo  $contentValue['ContentValues']['value'];?> </textarea>
			</p>
  		</div>
	</div>
</div>
<?php echo $this->Form->end('Set Text');?>