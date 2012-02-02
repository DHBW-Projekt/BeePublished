<?php $this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>

<div id="menu" class="overlay">
    <ol class="nav">
    	<?php 
    		if($mContext == 'singleGallery'){
    			echo "<li>";
    			echo $this->Html->link(__('Assign gallery'),array('plugin' => 'Gallery', 'controller' => 'DisplayGallery', 'action' => 'setGalleryAdminTab', $ContentId,$mContext));
    			echo "</li>";
    		} else if ($mContext == 'singleImage'){
    			echo "<li>";
    			echo $this->Html->link(__('Assign image'),array('plugin' => 'Gallery', 'controller' => 'DisplayImage', 'action' => 'setImageAdminTab', $ContentId,$mContext));	    			
    			echo "</li>";
    		}
    		echo "<li>";
    		echo $this->Html->link(__('Manage images'),array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'index', $ContentId,$mContext));
    		echo "</li>";
    		
    		/*
    		echo "<li>";
    		echo $this->Html->link(__('Create gallery'),array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'create', $ContentId,$mContext));
    		echo "</li>";
    		*/
    		echo "<li>";
    		echo $this->Html->link(__('Manage Galleries'),array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'index', $ContentId,$mContext));
    		echo "</li>";	
    	?>
    </ol>
    <div style="clear:both;"></div>
</div>