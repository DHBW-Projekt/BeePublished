<?php
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->css('/css/design');
	echo $this->Html->css('/css/template');
	echo $this->Html->script('/newsletter/js/newsletter', true);
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true);
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
	
    echo $this->Html->scriptBlock(
    	'$(function() {
    		$("#tabs").tabs();
    		$("#tabs").tabs("select",1);
		});
    	',array('inline' => true)
    );
    
    
    $validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
?>

<div id="tabs">
	<ul>
		
		<li><a href="#tabs-1">Newsletter</a></li>
		<li><a href="#tabs-2">Recipients</a></li>
		<li><a href="#tabs-3">Templates</a></li>
		<li><a href="#tabs-4">General settings</a></li>

	</ul>
	<div id="tabs-1">
		<?php 
		echo $this->element('RecipientsList');
		?>
	</div>
	<div id="tabs-2">
		<?php 
			echo $this->element('addRecipient');			
			echo $this->element('RecipientsList');
		?>
	</div>
	<div id="tabs-3">
		<p>geht</p>
	</div>
	<div id="tabs-4">
		<p>doch</p>
	</div>
</div>

