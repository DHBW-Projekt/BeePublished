<?php $this->Helpers->load('Time');?>
<?php $this->Helpers->load('Paginator');?>
<?php $this->Html->css('guestbook',null,array('inline' => false));?>

<div id='guestbook_write'>
	<p>&nbsp</p>
	<?php
	echo $this->Form->create('GuestbookPost',array('url' => array('plugin' => 'Guestbook',
														   		  'controller' => 'GuestbookApp',
														   		  'action' => 'save')));
	echo $this->Form->input('author', array('label' => __('Name')));
	echo $this->Form->input('title', array('label' => __('Titel')));
	echo $this->Form->input('text', array('label' => __('Text'),
										  'rows' => '3'));
	echo $this->Form->end('Eintrag speichern');
	?>
	<p>&nbsp</p>
</div>

<div id='guestbook_display'>

	<div class='guestbook_navigation'>
	<?php
	$paging_params = $this->Paginator->params();
	if ($paging_params['count'] > 0){
		echo $this->Paginator->counter(__('Einträge {:start} bis {:end} von {:count}, Seite {:page} von {:pages} '));
		if ($this->Paginator->hasPrev()){
			echo $this->Paginator->prev('<< ');
		}
		echo $this->Paginator->numbers();
		if ($this->Paginator->hasNext()){
			echo $this->Paginator->next(' >>');
		}
	}
	?>
	</div>
	
	<?php foreach($data as $GuestbookPost):?>

		<div class='guestbook_post'>
			<p>
			<?php 
				if (array_key_exists('released' , $GuestbookPost['GuestbookPost'])) {
					echo $this->Html->link('Eintrag freigeben',
				    	array('plugin' => 'Guestbook', 'controller' => 'GuestbookApp', 'action' => 'release', $GuestbookPost['GuestbookPost']['id']));
				}
				if (array_key_exists('deleted' , $GuestbookPost['GuestbookPost'])) {
					echo $this->Html->link('Eintrag entfernen',
						array('plugin' => 'Guestbook', 'controller' => 'GuestbookApp', 'action' => 'delete', $GuestbookPost['GuestbookPost']['id']),
						array(),
						__('Soll der Eintrag wirklich entfernt werden?'));
				}
			?>
			<?php echo $GuestbookPost['GuestbookPost']['author'] . __(' am ') . $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . __(' um ') . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?>
			</p>
			<p><?php echo $GuestbookPost['GuestbookPost']['title']?></p>
			<p><?php echo $GuestbookPost['GuestbookPost']['text']?></p>
			<p>&nbsp</p>
		</div>
		
	<?php endforeach;?>

	<div class='guestbook_navigation'>
		<?php 
		$paging_params = $this->Paginator->params();
		if ($paging_params['count'] > 0){
			echo $this->Paginator->counter(__('Seite {:page} von {:pages} '));
			if ($this->Paginator->hasPrev()){
				echo $this->Paginator->prev('<< ');
			}
			echo $this->Paginator->numbers();
			if ($this->Paginator->hasNext()){
				echo $this->Paginator->next(' >>');
			}
		}
		?>
	</div>

</div>


