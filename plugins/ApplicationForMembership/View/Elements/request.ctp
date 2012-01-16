<?php $DateTimeHelper = $this->Helpers->load('Time');?>

<div id='application_for_membership_form'>
	<h2>Application for membership</h2>
	
	<?php
		$validationError = $this->Session->read('Validation.ApplicationMembership.validationErrors');
		echo $this->Session->flash('ApplicationMembership');
		
	 	echo $this->Form->create('ApplicationMembership', array('url' => $url.'/applicationformembership/send'));	
	 ?>
	<table>
		<tr>
			<td colspan="2">I hereby apply for membership in this association:</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('type', __('Membership*'));?></td>
			<td><?php 
				$options = array('true' => 'active','false' => 'passive');
				echo $this->Form->select('type', $options, array('label' => false));
				?>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('title', __('Form of address*'));?></td>
			<td><?php 
					$options = array('F' => 'Ms/Mrs','M' => 'Mr');
					echo $this->Form->select('title', $options, array('label' => false));
				?>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('last_name', __('Lastname*'));?></td>
			<td><?php echo $this->Form->input('last_name', array('label' => false)); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('first_name', __('Firstname*'));?></td>
			<td><?php echo $this->Form->input('first_name', array('label' => false)); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('date_of_birth', __('Date of birth'));?></td>
			<td><?php echo $this->Form->dateTime($fieldName = 'date_of_birth', $dateFormat = 'DMY', $timeFormat = null, $attributes = array('label' => false, 'dateFormat' => 'DMY', 'minYear' => date("Y") - 100, 'maxYear' => date("Y"), 'monthNames' => true, 'empty' => ' ')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('email', __('Email*'));?></td>
			<td><?php echo $this->Form->input('email', array('label' => false)); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('telephone', __('Telephone'));?></td>
			<td><?php echo $this->Form->input('telephone', array('label' => false));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('street', __('Street and street number*'));?></td>
			<td><?php echo $this->Form->input('street', array('label' => false));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('zip', __('Zip*'));?></td>
			<td><?php echo $this->Form->input('zip', array('label' => false)); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('city', __('City*'));?></td>
			<td><?php echo $this->Form->input('city', array('label' => false)); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->label('comment', __('Comment'));?></td>
			<td><?php echo $this->Form->input('comment', array('label' => false, 'rows' => '4')); ?></td>
		</tr>
		<tr>
			<td colspan="2">The marked fields(*) are required.</td>
		</tr>
	</table>
	<?php echo $this->Form->end('Send');?>
</div>
