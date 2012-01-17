<div id='guestbook_display'>
		
	<?php foreach($data as $GuestbookPost):?>
	
		<div class='guestbook_post'>		
			<div class='guestbook_post_author'>
				<?php echo $GuestbookPost['GuestbookPost']['author'] . __(' on ') . $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . __(' at ') . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?>
			</div>				
			<div class='guestbook_post_title'>
				<?php echo $GuestbookPost['GuestbookPost']['title']?>
				<?php // creates release and delete links for admins/editors						
					if ($this->PermissionValidation->actionAllowed($pluginId, 'delete')) {
						echo $this->Form->postLink($this->Html->image('/img/delete.png', array( 'alt' => __('Delete post'))),
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
		<?php // Pagination get currnet page and create prev / next page accordingly - $url is used to get working links
			$paging_params = $this->Paginator->params();
			if ($paging_params['count'] > 0){
				echo 'Page ';
				$currentPageNumber = $this->Paginator->current();
// 				$PaginatorParams = $this->Paginator->params();
// 				$lastPageNumber = $PaginatorParams['pageCount'];
				if ($this->Paginator->hasPrev()){
					echo $this->Html->link(__('<<'), $url . '/page:' . ($currentPageNumber - 1));
					echo '&nbsp';
					echo $this->Html->link(($currentPageNumber -1), $url . '/page:' . ($currentPageNumber - 1));
					echo ' | ';
				}
				echo $currentPageNumber;
				if ($this->Paginator->hasNext()){
					echo ' | ';
					echo $this->Html->link(($currentPageNumber +1), $url . '/page:' . ($currentPageNumber + 1));
					echo '&nbsp';
					echo $this->Html->link(__('>>'), $url . '/page:' . ($currentPageNumber + 1));
				}
			}
		?>
	</div>

</div>