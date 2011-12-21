<div id="tabs">
<ul>
	<li><a href="#tabs-1">Speiseplan</a></li>
	<li><a href="#tabs-2">Kategorien</a></li>
	<li><a href="#tabs-3">Einträge</a></li>
</ul>
<div id="tabs-1">
	<?php echo $this->element('Menus');?>
</div>
<div id="tabs-2">
	<?php echo $this->element('Categories');?>
</div>
<div id="tabs-3">
	<?php echo $this->element('Entries');?>
</div>
</div>

<?=$ajax->tabs('tabs')?>
            