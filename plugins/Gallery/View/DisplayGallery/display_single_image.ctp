<?php 
$this->Helpers->load('SocialNetwork');
echo '<div style="clear:both;"></div>';
echo '<img src="'.$this->webroot.$data['image']['path_to_pic'].'" width="700" alt="imagePreview"/>'
?>
<div class='showFullNewsSocial'>
		<?php
			//Facebook
			echo $this->SocialNetwork->insertFacebookShare();
		?>
</div>
<div style="clear:both;"></div>