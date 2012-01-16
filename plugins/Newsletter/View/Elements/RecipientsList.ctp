<?php

?>

<table>
	<colgroup>
		<col />
		<col />
		<col />
	</colgroup>
	<tr>
		<th>Email</th>
		<th>User-ID</th>
	</tr>
	<?php

	if (isset($recipients)){
		foreach($recipients as $recipient){
			echo '<tr>';
			echo '<td>'.$recipient['NewsletterRecipient']['email'].'</td>';
			echo '<td>'.$recipient['NewsletterRecipient']['user_id'].'</td>';
			// 					echo '<td>'.$recipient['NewsletterRecipient']['active'].'</td>';
			echo '<td>';
			echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
						'height' => 20, 
						'width' => 20, 
						'alt' => __('[x]Delete'))),
			array(
							'plugin' => 'Newsletter', 
							'controller' => 'Subscription', 
							'action' => 'setRecipientInactiveByEmail', $recipient['NewsletterRecipient']['email']),
			array(
								'escape' => false, 
								'title' => __('Delete recipient')),
			__('Do you really want to delete this recipient?'));
			// 					echo $this->Html->image('/app/webroot/img/delete.png',
			// 											array(
			// 												'style' => 'float: left',
			// 												'width' => '20px',
			// 												'alt' => '[x]Delete',
			// 												'url' => array(
			// 													'plugin' => 'Newsletter',
			// 													'controller' => 'Subscription',
			// 													'action' => 'setRecipientInactiveByEmail', $recipient['NewsletterRecipient']['email'])));
			echo '</td>';
			echo '</tr>';
		}
		$paging_params = $this->Paginator->params('NewsletterRecipient');
		if ($paging_params['count'] > 0){
			// 				echo $this->Paginator->counter(('Entrys {:start} to {:end} of {:count}, page {:page} of {:pages} '), array('model' => 'NewsletterRecipient'));
			echo $this->Paginator->counter(array( 'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}',
												'model' => 'NewsletterRecipient'));

			if ($this->Paginator->hasPrev('NewsletterRecipient')){
				echo $this->Paginator->prev('<< ', array('model' => 'NewsletterRecipient'));
			}
			echo $this->Paginator->numbers(array('model' => 'NewsletterRecipient'));
			if ($this->Paginator->hasNext('NewsletterRecipient')){
				echo $this->Paginator->next(' >>', array('model' => 'NewsletterRecipient'));
			}

		}
	}



	?>
</table>
