
<div class='guestbook_write'>

<?php echo $this->Form->create('GuestbookPost', array('url' => array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost','action' => 'save')));?>
	<table>
		<tr>
			<td class="guestbook_label"> <?php echo $this->Form->label('GuestbookPost.author', __('Name:'));?></td>
			<td> <?php //for each input field check whether a value is already present or an error had occured
						if (($input != NULL) && array_key_exists('author', $input['GuestbookPost'])){
							echo $this->Form->input('GuestbookPost.author', array('label' => false, 'value' => $input['GuestbookPost']['author']));
						} else {
							echo $this->Form->input('GuestbookPost.author', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('author', $errors) && array_key_exists('0', $errors['author'])){
							echo $this->Html->div('validation_error',$errors['author']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td class="guestbook_label"> <?php echo $this->Form->label('GuestbookPost.title', __('Title:'));?></td>
			<td> <?php if (($input != NULL) && array_key_exists('title', $input['GuestbookPost'])){
							echo $this->Form->input('GuestbookPost.title', array('label' => false, 'value' => $input['GuestbookPost']['title']));
						} else{
							echo $this->Form->input('GuestbookPost.title', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
							echo $this->Html->div('validation_error',$errors['title']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td class="guestbook_label"> <?php echo $this->Form->label('GuestbookPost.text', __('Text:'));?></td>
			<td> <?php if (($input != NULL) && array_key_exists('text', $input['GuestbookPost'])){
							echo $this->Form->input('GuestbookPost.text', array('label' => false, 'value' => $input['GuestbookPost']['text']));
						} else{
							echo $this->Form->input('GuestbookPost.text', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['text'])){
							echo $this->Html->div('validation_error',$errors['text']['0']);
						}
					?>
			</td>
		</tr>
	</table>
	<?php echo $this->Form->end('Save Post');?>
</div>


