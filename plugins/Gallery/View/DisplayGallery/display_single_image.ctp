<?php 
$this->Helpers->load('SocialNetwork');
echo '<div style="clear:both;"></div>';

echo $this->Html->image($data['image']['path_to_pic'],
array(
		'style' => 'float: left; width:100%', 
		'alt' => 'ImagePreview'
)
);
?>
<div class='showFullNewsSocial'>
		<?php
			//Facebook
			echo $this->SocialNetwork->insertFacebookShare();
		?>
</div>
<div style="clear:both;"></div>