<?php $DateTimeHelper = $this->Helpers->load('Time');?>

<div id='application_membership_form'>
<h2><?php __d('application_membership','Application for membership'); ?></h2>
<?php
$validationError = $this->Session->read('Validation.ApplicationMembership.validationErrors');
echo $this->Session->flash('ApplicationMembership');

echo $this->Form->create('ApplicationMembership', array('url' => $url.'/applicationmembership/send'));
?>

<br>
<?php __('application_membership','I hereby apply for membership in this association:'); ?>
<br>

<div class="input">
<?php echo $this->Form->label('type', __d('application_membership','Membership*'));?>
<?php
$options = array('true' => 'active','false' => 'passive');
echo $this->Form->select('type', $options, array('label' => false));
?>
</div>

<div class="input">
<?php echo $this->Form->label('title', __d('application_membership','Form of address*'));?>
<?php
$options = array('F' => 'Ms/Mrs','M' => 'Mr');
echo $this->Form->select('title', $options, array('label' => __d('application_membership','Form of address*')));
?>
</div>

<!--
<?php echo $this->Form->label('last_name', __d('application_membership','Lastname*'));?>
-->
<?php echo $this->Form->input('last_name', array('label' => __d('application_membership','Lastname*'))); ?>

<!--
<?php echo $this->Form->label('first_name', __('Firstname*'));?>
-->
<?php echo $this->Form->input('first_name', array('label' => __d('application_membership','Firstname*'))); ?>

<div class="input">
<?php echo $this->Form->label('date_of_birth', __d('application_membership','Date of birth'));?>
<?php echo $this->Form->dateTime($fieldName = 'date_of_birth',
$dateFormat = 'DMY',
$timeFormat = null,
$attributes = array('label' => false, 'dateFormat' => 'DMY', 'minYear' => date("Y") - 100, 'maxYear' => date("Y"), 'monthNames' => true, 'empty' => ' ')); ?></td>
</div>

<!--<?php echo $this->Form->label('email', __('Email*'));?>-->
<?php echo $this->Form->input('email', array('label' => __d('application_membership','Email*'))); ?>

<!--<?php echo $this->Form->label('telephone', __('Telephone'));?>-->
<?php echo $this->Form->input('telephone', array('label' => __d('application_membership','Telephone')));?>

<!--<?php echo $this->Form->label('street', __('Street and street number*'));?>-->
<?php echo $this->Form->input('street', array('label' => __d('application_membership','Street and street number*')));?>

<!--<?php echo $this->Form->label('zip', __('Zip*'));?>-->
<?php echo $this->Form->input('zip', array('label' => __d('application_membership','Zip*'))); ?>

<!--<?php echo $this->Form->label('city', __('City*'));?>-->
<?php echo $this->Form->input('city', array('label' => __d('application_membership','City*'))); ?>

<!--<?php echo $this->Form->label('comment', __('Comment'));?>-->
<?php echo $this->Form->input('comment', array('label' => __d('application_membership','Comment'), 'rows' => '4','id'=>'ApplicationMembershipComment')); ?>

<?php __d('application_membership','The marked fields(*) are required.'); ?>

<?php echo $this->Form->end(__d('application_membership','Send'));?>
</div>


