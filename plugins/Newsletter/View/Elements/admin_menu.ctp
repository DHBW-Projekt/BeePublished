<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
<ol class="nav">
	<li><?php echo $this->Html->link('Newsletters',array('plugin' => 'Newsletter', 'controller' => 'NewsletterLetters', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Recipients',array('plugin' => 'Newsletter', 'controller' => 'NewsletterRecipients', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('General Settings',array('plugin' => 'Newsletter', 'controller' => 'NewsletterSettings', 'action' => 'index'));?></li>
</ol>
<div style="clear: both;"></div>
</div>
