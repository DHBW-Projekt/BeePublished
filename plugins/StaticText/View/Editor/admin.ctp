<h1>Set Text</h1>
<?php
	$this->Html->script('/StaticText/js/editText', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->script('/ckeditor/jquery', false); 
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->script("/StaticText/js/StaticText", true);
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true); 
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
	    echo $this->Html->scriptBlock('$(function() {
			$( "#tabs" ).tabs();
			});',array('inline' => true));
?>
<div class="demo">
	<?php echo $this->Form->create('ContentValues');?>
	<div id="tabs">
		<div id="tabs-1">
			<p>
				<textarea id="editTextEditor" name="editTextEditor"><?php echo  $contentValue['ContentValues']['value'];?> </textarea>
			</p>
			<?php echo $this->Form->end('Set Text');?>
			<script type='text/javascript'>
			  	var ck_textContent = CKEDITOR.replace( 'editTextEditor' );  
			</script>
  		</div>
	</div>
</div>