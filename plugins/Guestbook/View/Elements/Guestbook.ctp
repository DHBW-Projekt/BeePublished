<?php $this->Helpers->load('Time');?>
<?php $this->Helpers->load('Paginator');?>
<?php $this->Html->css('/Guestbook/css/guestbook',null,array('inline' => false));?>

<?php $input = $this->Session->read('Validation.GuestbookPost.data');?>
<?php $errors = $this->Session->read('Validation.GuestbookPost.validationErrors');?>

<?php //needed for pagination
	  $route = substr($this->here, strlen($this->base));
	  if (strrpos ($route, '/') != 0) {
	  	$waste = substr($route, strrpos($route, '/'));
	  	$route = substr($route, 0 , (strlen($route)-strlen($waste)));
	  }
?>

<?php echo $this->Session->flash('Guestbook');?>

<div id='guestbook_write'>

<?php echo $this->Form->create('GuestbookPost', array('url' => array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost','action' => 'save')));?>
	<table>
		<tr>
			<td> <?php echo $this->Form->label('author', __('Name'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('author', $input['GuestbookPost'])){
							echo $this->Form->input('author', array('label' => false, 'value' => $input['GuestbookPost']['author']));
						} else {
							echo $this->Form->input('author', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('author', $errors) && array_key_exists('0', $errors['author'])){
							echo $this->Html->div('validation_error',$errors['author']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('title', __('Title'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('title', $input['GuestbookPost'])){
							echo $this->Form->input('title', array('label' => false, 'value' => $input['GuestbookPost']['title']));
						} else{
							echo $this->Form->input('title', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
							echo $this->Html->div('validation_error',$errors['title']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('text', __('Text'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('text', $input['GuestbookPost'])){
							echo $this->Form->input('text', array('label' => false, 'value' => $input['GuestbookPost']['text']));
						} else{
							echo $this->Form->input('text', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['text'])){
							echo $this->Html->div('validation_error',$errors['text']['0']);
						}
					?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td> <?php echo $this->Form->end('Save Post');?>
			</td>
	</table>
</div>

<div id='guestbook_display'>

	<div class='guestbook_navigation'>
	<?php
	$paging_params = $this->Paginator->params();
	if ($paging_params['count'] > 0){
		echo $this->Paginator->counter(__('Posts {:start} to {:end} of {:count}, Page {:page} of {:pages}, '));
		if ($this->Paginator->hasPrev()){
			echo $this->Html->link('<< ', $route . '/page:' . ($this->Paginator->current() - 1));
		}
		if ($this->Paginator->hasNext()){
			echo $this->Html->link('>> ', $route . '/page:' . ($this->Paginator->current() + 1));
		}
	}
	?>
	</div>
		
	<?php foreach($data as $GuestbookPost):?>
	
		<div class='guestbook_post'>		
			<div class='guestbook_post_author'>
				<?php echo $GuestbookPost['GuestbookPost']['author'] . __(' on ') . $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . __(' at ') . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?>
			</div>				
			<div class='guestbook_post_title'>
				<?php echo $GuestbookPost['GuestbookPost']['title']?>
				<?php 						
					if (($GuestbookPost['GuestbookPost']['released'] == '0000-00-00 00:00:00') && $this->PermissionValidation->actionAllowed($pluginId, 'release')) {
						echo $this->Html->link($this->Html->image('/img/check.png', array('height' => 16, 'width' => 16, 'alt' => __('Release post'))),
							array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost', 'action' => 'release', $GuestbookPost['GuestbookPost']['id']),
							array('escape' => false, 'title' => __('Release post')));
					}
					if (($GuestbookPost['GuestbookPost']['deleted'] == '0000-00-00 00:00:00') && $this->PermissionValidation->actionAllowed($pluginId, 'delete')) {
						echo $this->Html->link($this->Html->image('/img/delete.png', array('height' => 16, 'width' => 16, 'alt' => __('Delete post'))),
							array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost', 'action' => 'delete', $GuestbookPost['GuestbookPost']['id']),
							array('escape' => false, 'title' => __('Delete post')),
							__('Do you really want to delete this post?'));
					}
				?>	
			</div>			
			<div class='guestbook_post_text'>
				<?php echo $GuestbookPost['GuestbookPost']['text']?>
			</div>			
		</div>
		
	<?php endforeach;?>

	<div class='guestbook_navigation'>
		<?php 
		$paging_params = $this->Paginator->params();
		if ($paging_params['count'] > 0){
			echo $this->Paginator->counter(__('Seite {:page} von {:pages}, '));
			if ($this->Paginator->hasPrev()){
				echo $this->Html->link('<< ', $route . '/page:' . ($this->Paginator->current() - 1));
			}
			if ($this->Paginator->hasNext()){
				echo $this->Html->link('>> ', $route . '/page:' . ($this->Paginator->current() + 1));
			}
		}
		?>
	</div>

</div>

