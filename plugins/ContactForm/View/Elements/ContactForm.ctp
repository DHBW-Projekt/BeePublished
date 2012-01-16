<!-- Frame to integrate the elements -->
<?php 
	//CALL stylesheet
	echo $this->Html->css('/ContactForm/css/contactform');
?>

<div id="contactform_content">
	<?php echo $this->element($data['Element'], array('data' => $data['data'], 'url' => $url) ); ?>
</div>