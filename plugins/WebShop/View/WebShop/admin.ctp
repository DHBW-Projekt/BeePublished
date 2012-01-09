<!-- Create new products for the catalog -->
	<?php
		echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
		echo $this->Html->script('/js/jquery-1.6.2.min.js', true);
		echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
		echo $this->Html->scriptBlock('$(function() {$( "#tabs" ).tabs();});',array('inline' => true));
	?>
	
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Artikel erstellen</a></li>
			<li><a href="#tabs-2">Artikel verwalten</a></li>
			<li><a href="#tabs-3">Einstellungen</a></li>
		</ul>
		<div id="tabs-1">
			<?php echo $this->Html->link("create", array('action' => 'create')); ?>
		</div>
		<div id="tabs-2">
			<?php echo $this->element("create"); ?>
		</div>
		<div id="tabs-3">
			<?php echo $this->element("settings"); ?>
		</div>
	</div>