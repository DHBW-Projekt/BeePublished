<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__('Newsletters'),array(
			'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterLetters', 
        	'action' => 'index', $contentID));?></li>
        <li><?php echo $this->Html->link(__('Recipients'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterRecipients', 
        	'action' => 'index', $contentID));?></li>
        <li><?php echo $this->Html->link(__('General Settings'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterSettings', 
        	'action' => 'index', $contentID));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>