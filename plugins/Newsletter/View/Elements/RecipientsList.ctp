<table>
	<colgroup>
		<col/>
		<col/>
		<col/>
	</colgroup>
	<tr>
		<th>Email</th>
		<th>User-ID</th>
		<th>Active</th>
	</tr>
	<?php
		if (isset($recipients)){
				foreach($recipients as $recipient){
					echo '<tr>';
					echo '<td>'.$recipient['NewsletterRecipient']['email'].'</td>';
					echo '<td>'.$recipient['NewsletterRecipient']['user_id'].'</td>';
					echo '<td>'.$recipient['NewsletterRecipient']['active'].'</td>';
					echo '<td>';
					echo $this->Html->image('/app/webroot/img/delete.png', 
											array(
												'style' => 'float: left', 
												'width' => '20px', 
												'alt' => '[x]Delete', 
												'url' => array(
													'plugin' => 'Newsletter', 
													'controller' => 'Subscription', 
													'action' => 'setRecipientInactiveByEmail', $recipient['NewsletterRecipient']['email'])));
					echo '</td>';
					echo '</tr>';
				}	
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