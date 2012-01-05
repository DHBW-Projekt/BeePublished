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
//	debug($NewsletterRecipient, $showHtml=null, $showFrom=true);
	//$data = $NewsletterRecipient;
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
	if (isset($recipients)){
	//	if (array_key_exists('NewsletterRecipient', $data)){
	//	$recipients = $data;
			foreach($recipients as $recipient){
				echo '<tr>';
				echo '<td>'.$recipient['NewsletterRecipient']['email'].'</td>';
				echo '<td>'.$recipient['NewsletterRecipient']['user_id'].'</td>';
				echo '<td>'.$recipient['NewsletterRecipient']['active'].'</td>';
				echo '</tr>';
			}
	//	}		
	}	
	?>
</table>