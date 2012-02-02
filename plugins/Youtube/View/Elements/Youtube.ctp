<?php $this->Html->css('/Youtube/css/template',null,array('inline' => false));?>

<div class="youtube_show">
<?php
if ($data == NULL || empty($data['YoutubeLink']['url'])){
	echo __d('Youtube', 'Please enter a video URL in the plugin configuration.');
} else { 
?>
<iframe width="640" height="360" src="<?php echo $data['YoutubeLink']['url']?>" frameborder="0" allowfullscreen></iframe>
<?php } ?>
</div>