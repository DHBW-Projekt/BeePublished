<!-- Frame to integrate the elements -->
<?php
//CALL stylesheet
echo $this->Html->css('/ApplicationForMembership/css/application_for_membership');
?>

<div id="application_for_membership_content">
	<?php echo $this->element($data['Element'], array('data' => $data['data'], 'url' => $url) ); ?>
</div>