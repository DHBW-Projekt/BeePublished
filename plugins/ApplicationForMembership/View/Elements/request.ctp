<?php echo $this->Session->flash('ApplicationForMembership');?>

<div id='application_for_membership_form'>

<?php echo $this->Form->create('ApplicationForMembership', 
					array('url' => array('url' => $url.'/applicationformembership/send')));?>
	<table>
	<tr>
			<td colspan="2">
			<h1>Application for membership</h1>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<br/>I hereby apply for membership in this association:
			<br/>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('formOfMembership', __('Membership'));?>
			</td>
			<td> <?php 
						$options = array('true' => 'active','false' => 'passive');
						if (($input != NULL) && array_key_exists('formOfMembership', $input['ApplicationForMembership'])){
							echo $this->Form->select('formOfMembership',$options, array('label' => false, 'value' => $input['ApplicationForMembership']['formOfMembership']));
						} else {
							echo $this->Form->select('formOfMembership',$options, array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('name', $errors) && array_key_exists('0', $errors['formOfMembership'])){
							echo $this->Html->div('validation_error',$errors['formOfMembership']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('title', __('Form of address'));?>
			</td>
			<td> <?php 
						$options = array('F' => 'Ms/Mrs','M' => 'Mr');
						if (($input != NULL) && array_key_exists('title', $input['ApplicationForMembership'])){
							echo $this->Form->select('title', $options, array('label' => false, 'value' => $input['ApplicationForMembership']['title']));
						} else {
							echo $this->Form->select('title', $options, array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
							echo $this->Html->div('validation_error',$errors['title']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('name', __('Name*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('name', $input['ApplicationForMembership'])){
							echo $this->Form->input('name', array('label' => false, 'value' => $input['ApplicationForMembership']['name']));
						} else {
							echo $this->Form->input('name', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('name', $errors) && array_key_exists('0', $errors['name'])){
							echo $this->Html->div('validation_error',$errors['name']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('firstname', __('Firstname*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('firstname', $input['ApplicationForMembership'])){
							echo $this->Form->input('firstname', array('label' => false, 'value' => $input['ApplicationForMembership']['firstname']));
						} else{
							echo $this->Form->input('firstname', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['firstname'])){
							echo $this->Html->div('validation_error',$errors['firstname']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('dateOfBirth', __('Date of birth'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('dateOfBirth', $input['ApplicationForMembership'])){
							echo $this->Form->input('dateOfBirth', array('label' => false, 'value' => $input['ApplicationForMembership']['dateOfBirth']));
						} else{
							echo $this->Form->input('dateOfBirth', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['dateOfBirth'])){
							echo $this->Html->div('validation_error',$errors['dateOfBirth']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('email', __('Email*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('email', $input['ApplicationForMembership'])){
							echo $this->Form->input('email', array('label' => false, 'value' => $input['ApplicationForMembership']['email']));
						} else{
							echo $this->Form->input('email', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['email'])){
							echo $this->Html->div('validation_error',$errors['email']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('telephone', __('Telephone'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('telephone', $input['ApplicationForMembership'])){
							echo $this->Form->input('telephone', array('label' => false, 'value' => $input['ApplicationForMembership']['telephone']));
						} else{
							echo $this->Form->input('telephone', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('telephone', $errors) && array_key_exists('0', $errors['telephone'])){
							echo $this->Html->div('validation_error',$errors['telephone']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('street', __('Street and street number*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('street', $input['ApplicationForMembership'])){
							echo $this->Form->input('street', array('label' => false, 'value' => $input['ApplicationForMembership']['street']));
						} else{
							echo $this->Form->input('street', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('street', $errors) && array_key_exists('0', $errors['street'])){
							echo $this->Html->div('validation_error',$errors['street']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('zip', __('Zip*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('zip', $input['ApplicationForMembership'])){
							echo $this->Form->input('zip', array('label' => false, 'value' => $input['ApplicationForMembership']['zip']));
						} else{
							echo $this->Form->input('zip', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('zip', $errors) && array_key_exists('0', $errors['zip'])){
							echo $this->Html->div('validation_error',$errors['zip']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('city', __('City*'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('city', $input['ApplicationForMembership'])){
							echo $this->Form->input('city', array('label' => false, 'value' => $input['ApplicationForMembership']['city']));
						} else{
							echo $this->Form->input('city', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('city', $errors) && array_key_exists('0', $errors['city'])){
							echo $this->Html->div('validation_error',$errors['city']['0']);
						}
					?>
			</td>
		</tr>
				<tr>
			<td> <?php echo $this->Form->label('comment', __('Comment'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('comment', $input['ApplicationForMembership'])){
							echo $this->Form->textarea('comment', array('label' => false, 'value' => $input['ApplicationForMembership']['comment']));
						} else{
							echo $this->Form->textarea('comment', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('comment', $errors) && array_key_exists('0', $errors['comment'])){
							echo $this->Html->div('validation_error',$errors['comment']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			The marked fields(*) are required.
			</td>
		</tr>
		<tr>
			<td></td>
			<td> <?php echo $this->Form->end('Send');?>
			</td>
		</tr>
	</table>
</div>

</div>

