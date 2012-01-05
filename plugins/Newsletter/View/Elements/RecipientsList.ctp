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