<?php
echo $this->element('admin_menu',array("contentId" => $contentId));

?>
<table border="0">
  <tr>
    <td>id</td>
    <td>title</td>
  </tr>
<?php 
if(isset($allImages)){
	foreach($allImages as $image){
		echo "<tr>";
		echo "<td>".$image['GalleryPicture']['id']."</td>";
		echo "<td>".$image['GalleryPicture']['title']."</td>";
		
		echo "<td>";

		    		echo $this->Html->link(
		    					$this->Html->image("check.png", array('width' => '32px')), 
		    					array('action' => 'setImage', $contentId, $image['GalleryPicture']['id']),
		    					array('escape' => False)
		    		);
		echo "</td>";		
		echo "</tr>";
	}
}

?>
</table>