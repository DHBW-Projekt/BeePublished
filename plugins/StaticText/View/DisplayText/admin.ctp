<h1>Set Text</h1>
<?php
	//embedding the needed scripts
	echo $this->Html->script('/static_text/js/editText', false);
	echo $this->Html->script('/ckeditor/ckeditor', false);
	echo $this->Html->script('/ckeditor/adapters/jquery', false);
?>
<div class="texteditor">
	<?php echo $this->Form->create('ContentValues');?><br>
			<p>
				<!-- is not working,  if the textarea is not html !? -->
				<textarea id="editTextEditor" name="editTextEditor"><?php echo  $contentValue['ContentValues']['value'];?> </textarea>
			</p>
</div>
<?php echo $this->Form->end('Set Text');?>