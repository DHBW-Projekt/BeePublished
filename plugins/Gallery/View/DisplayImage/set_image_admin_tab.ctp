<?php 
echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
$this->Html->script('/gallery/js/gallerytableassign', false);
echo $this->Session->flash('Image assigned');

$curr_picid=-1;
if(array_key_exists('pictureID', $data['CurrPicture'])){
	$curr_picid = $data['CurrPicture']['pictureID'];
}

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th>'.__('Id').'</th>';
			echo '<th>'.__('Preview').'</th>';
			echo '<th>'.__('Title').'</th>';
			echo '<th>'.__('Assigned').'</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

foreach ($data['AllPictures'] as $picture){
	echo '<tr class="Gallery_row">';
		echo "<td>".$picture['id']."</td>";
		
		
		echo '<td>'.'<img src="'.$this->webroot.$picture['thumb'].'" width="35px" /></td>';
		
		echo '<td>'.$picture['title']."</td>";
		echo "<td>";
		if ($picture['id'] == $curr_picid){
									$class = "";
									$style = "display:inline";
			} else {
									$class = "set_gallery_link";
									$style = "display:none";
		}
		
	echo $this->Html->link(
	$this->Html->image("check.png", array('width' => '16px')),
	array('action' => 'setImage', $ContentId, $picture['id'],$mContext),
	array('escape' => False, 'class' => $class, "style" => $style));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

?>