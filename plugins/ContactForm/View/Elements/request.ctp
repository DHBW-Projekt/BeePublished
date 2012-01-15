<!-- contact form screen -->
<?php 
	$this->Helpers->load('Recaptcha');
?>

<div id='contactform'>
	<div class = 'ContactForm'>
		<b>Contact Form</b></br>
		<?php 
			echo $this->Form->create('ContactForm', array('url' => $url.'/contactform/sendForm'));
		?>
			<table>
				<tr>
					<td><?php echo $this->Form->label('last_name', __('Last Name: '));?></td>
					<td><?php echo $this->Form->input('last_name', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('first_name', __('First Name: '));?></td>
					<td><?php echo $this->Form->input('first_name', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('email', __('E-Mail: '));?></td>
					<td><?php echo $this->Form->input('email', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('subject', __('Subject: '));?></td>
					<td><?php echo $this->Form->input('subject', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('body', __('Message: '));?></td>
					<td><?php echo $this->Form->input('body', array('label' => '', 'rows' => '4'));?></td>
				</tr>
				<tr>
					<td></td>
					<td><?php /*echo $this->Recaptcha->display_form();*/ ?></td>
				</tr>
				<tr width="100%">
					<td colspan="2"><?php echo $this->Form->end('Send');?></td>
				</tr>
			</table>
	</div>
</div>