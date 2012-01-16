<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<?php
$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write');
$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
?>
<div id="menu" class="overlay">
<ol class="nav">
<?php
if($writeAllowed){
	echo '<li>'.$this->Html->link('Write News',array('controller' => 'NewsEntries', 'action' => 'create', $contentId)).'</li>';
}
if($publishAllowed){
	echo '<li>'.$this->Html->link('Publish News',array('controller' => 'NewsEntries', 'action' => 'publish', $contentId)).'</li>';
}
?>
	<li><?php echo $this->Html->link('General',array('controller' => 'ShowNews', 'action' => 'general', $contentId))?></li>
</ol>
<div style="clear: both;"></div>
</div>

