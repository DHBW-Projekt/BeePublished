<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>
<div id="menu" class="overlay">
    <ol class="nav">
       	<li><?php echo $this->Html->link('Set Gallery',array('plugin' => 'Gallery', 'controller' => 'DisplayGallery', 'action' => 'setGalleryAdminTab', $ContentId));?></li>
        <li><?php echo $this->Html->link('Upload Images',array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'create', $ContentId));?></li>
   		<li><?php echo $this->Html->link('Create Gallery',array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'create', $ContentId));?></li>
   		<li><?php echo $this->Html->link('Manage Galleries',array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'index', $ContentId));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>