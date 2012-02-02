<?php
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Sebastian Haase
*
* @description element to display posts from database
*/
App::uses('Sanitize', 'Utility');
$this->Helpers->load('BBCode');
?>

<div id='guestbook_display'>
		
	<?php foreach($data as $GuestbookPost):?>
	
		<div class='guestbook_post border-color1'>		
			<div class='guestbook_post_author'>
				<?php echo Sanitize::html($GuestbookPost['GuestbookPost']['author']) . __d('Guestbook', ' on ') . $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . __d('Guestbook', ' at ') . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?>
			</div>				
			<div class='guestbook_post_title'>
				<?php echo Sanitize::html($GuestbookPost['GuestbookPost']['title']);?>
				<?php // creates release and delete links for admins/editors						
					if ($this->PermissionValidation->actionAllowed($pluginId, 'delete')) {
						echo $this->Form->postLink($this->Html->image('/img/delete.png', array( 'alt' => __d('Guestbook','Delete'))),
							array('plugin' => 'Guestbook', 'controller' => 'GuestbookPost', 'action' => 'delete', $contentId, $GuestbookPost['GuestbookPost']['id']),
							array('escape' => false, 'title' => __d('Guestbook','Delete')),
							__d('Guestbook','Do you really want to delete this post?'));
					}
				?>	
			</div>			
			<div class='guestbook_post_text'>
				<?php echo $this->BBCode->transformBBCode(Sanitize::html($GuestbookPost['GuestbookPost']['text']));?>
			</div>			
		</div>
		
	<?php endforeach;?>

	<div class='guestbook_navigation'>
		<?php // Pagination get currnet page and create prev / next page accordingly - $url is used to get working links
			$paging_params = $this->Paginator->params();
			if ($paging_params['count'] > 0){
				echo 'Page ';
				$currentPageNumber = $this->Paginator->current();
				if ($this->Paginator->hasPrev()){
					echo $this->Html->link('<<', $url . '/page:' . ($currentPageNumber - 1));
					echo '&nbsp';
					echo $this->Html->link(($currentPageNumber -1), $url . '/page:' . ($currentPageNumber - 1));
					echo ' | ';
				}
				echo $currentPageNumber;
				if ($this->Paginator->hasNext()){
					echo ' | ';
					echo $this->Html->link(($currentPageNumber +1), $url . '/page:' . ($currentPageNumber + 1));
					echo '&nbsp';
					echo $this->Html->link('>>', $url . '/page:' . ($currentPageNumber + 1));
				}
			}
		?>
	</div>

</div>