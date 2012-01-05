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
					echo '</tr>';
				}	
		}	
	?>
</table>