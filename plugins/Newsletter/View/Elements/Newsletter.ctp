<div id='list'>
<table>
	<colgroup>
		<col/>
		<col/>
		<col/>
	</colgroup>
	<tr>
		<th>Subject</th>
		<th>Date</th>
	</tr>
	

	
	<?php
		if (isset($newsletters)){
				foreach($newsletters as $newsletter){
					echo '<tr>';
					echo '<td>';				
					echo $this->Html->link($newsletter['NewsletterLetter']['subject'], array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'test'));
					echo '</td>';
					echo '<td>'.$newsletter['NewsletterLetter']['date'].'</td>';
// 					echo '<td>';
// 					echo $this->Html->image('/app/webroot/img/delete.png', 
// 											array(
// 												'style' => 'float: left', 
// 												'width' => '20px', 
// 												'alt' => '[x]Delete', 
// 												'url' => array(
// 													'plugin' => 'Newsletter', 
// 													'controller' => 'Subscription', 
// 													'action' => 'setRecipientInactiveByEmail', $recipient['NewsletterRecipient']['email'])));
// 					echo '</td>';
					echo '</tr>';
				}	
// 			debug($this->Paginator, $showHtml=null, $showFrom=true);
			$paging_params = $this->Paginator->params();
			if ($paging_params['count'] > 0){
				echo $this->Paginator->counter(__('Entrys {:start} to {:end} of {:count}, page {:page} of {:pages} '));
			
				if ($this->Paginator->hasPrev()){
					echo $this->Paginator->prev('<< ');
				}
				echo $this->Paginator->numbers();
				if ($this->Paginator->hasNext()){
					echo $this->Paginator->next(' >>');
				}
			
			}
		}	

	

	?>
</table>
</div>
<div id='editor'>
 <?php 
 	echo '<br><br><br><br>';
 	echo $this->Form->input('edit', array('label' => '', 'id' => 'edit'));
 ?>
</div>

