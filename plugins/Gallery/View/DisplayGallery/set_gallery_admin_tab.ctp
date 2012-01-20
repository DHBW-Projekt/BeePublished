<?php 
$this->Html->css('menu-design', NULL, array('inline' => false));
$this->Html->css('menu-template', NULL, array('inline' => false));
?>
<div id="menu" class="overlay">
    <ol class="nav">
    	<li><?php echo $this->Html->link('Set Gallery',array('plugin' => 'Gallery', 'controller' => 'DisplayGallery', 'action' => 'setGalleryAdminTab', $data['ContentId']));?></li>
        <li><?php echo $this->Html->link('Manage Images',array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'index', $data['ContentId']));?></li>
   		<li><?php echo $this->Html->link('Manage Galleries',array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'index', $data['ContentId']));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>

<?php 

echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($data['AllGalleries'] as $gallery){
	echo "<tr>";
	echo "<td>".$gallery['GalleryEntry']['title']."</td>";
	echo "<td>";
	echo $this->Html->link($this->Html->image("check.png", array('width' => '32px')),array('action' => 'setGallery', $data['ContentId'], $gallery['GalleryEntry']['id']),array('escape' => False));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

//debug($data);

?>