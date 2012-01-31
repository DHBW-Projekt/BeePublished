<?php 
$this->Helpers->load('SocialNetwork');
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo '<div style="clear:both;"></div>';


echo '<h1>'.$data['image']['title'].'</h1>';

echo '<div style ="margin-top:20px; margin-bottom:10px; text-algin:center">';
echo '<img src="'.$this->webroot.$data['image']['path_to_pic'].'" width="700" alt="imagePreview"/>'
?>
</div>
<div class='showFullNewsSocial' >
		<?php
			//Facebook
			echo $this->SocialNetwork->insertFacebookShare();
		?>
</div>
<div style="clear:both;"></div>