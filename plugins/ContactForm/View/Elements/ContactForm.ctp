<!-- Frame to integrate the elements -->

<?php
	//LOAD css file
	echo $this->Html->css('/ContactForm/css/contact_form');
?>

<div id="contactform_content">
	<?php echo $this->element($data['Element'], array('data' => $data['data'], 'url' => $url)); ?>
</div>