<!-- Frame to integrate the elements -->
<?php
//CALL stylesheet
echo $this->Html->css('/ApplicationMembership/css/applicationmembership');
?>

<div id="application_membership_content">
<?php echo $this->element($data['Element'], array('data' => $data['data'], 'url' => $url) ); ?>
</div>