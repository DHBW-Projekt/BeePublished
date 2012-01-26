<?php 
$this->Html->css('menu-design', NULL, array('inline' => false));
$this->Html->css('menu-template', NULL, array('inline' => false));
$settingsAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'ChangeNewsletterSettings');
$recipientsAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'unSubscribeOtherUsers');
?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__d('newsletter','Newsletters'),array(
			'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterLetters', 
        	'action' => 'index', $contentID, $pluginId));?></li>
<?php         	
if($recipientsAllowed){
	echo '<li>';
		echo $this->Html->link(__d('newsletter','Recipients'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterRecipients', 
        	'action' => 'index', $contentID, $pluginId));
       echo '</li>';
};
if($settingsAllowed){
	echo '<li>';
		echo $this->Html->link(__d('newsletter','General Settings'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterSettings', 
        	'action' => 'index', $contentID, $pluginId));
	echo '</li>';
};
?>
    </ol>
    <div style="clear:both;"></div>
</div>