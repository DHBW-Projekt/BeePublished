<!-- Create new products for the catalog -->
	
	<?php $this->Html->script('/web_shop/js/admin', false); ?>

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Produkte verwalten</a></li>
			<li><a href="#tabs-2">Einstellungen</a></li>
		</ul>
		<div id="tabs-1">
			<?php echo $this->element($productAdminView); ?>
		</div>
		<div id="tabs-2">
			<?php echo $this->element("settings"); ?>
		</div>
	</div>