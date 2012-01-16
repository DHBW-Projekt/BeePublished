<?php $this->Html->script('jquery/jquery.quicksearch', false); ?>
<?php $this->Html->script('/newsletter/js/newsletter', false); ?>
<?php
echo $this->element('admin_menu');
// echo $this->Html->css('/newsletter/css/newsletter');
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');
echo 'Recipients';
echo $this->Form->create('add',array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterRecipients',
			'action' => 'add')));
echo $this->Form->input('NewsletterRecipient.email', array('label' => 'E-Mail:'));
echo $this->Html->div('validation_error',$validationErrors['email'][0]);
echo $this->Form->end('Add');
echo $this->Session->flash('NewsletterRecipient');
echo '</div>';

?>
<form>Search Recipient: <input type="text" id="search_recipient"/></form>
<table id='recipients'>
	<thead>
	<tr>
		<th>Email</th>
		<th>Username</th>
	</tr>
	</thead>
	<tbody>

<?php
// 	echo '<tbody>';
		if (isset($recipients)){
				foreach($recipients as $recipient){
					echo '<tr>';
					echo '<td>'.$recipient['NewsletterRecipient']['email'].'</td>';
					echo '<td>'.$recipient['User']['username'].'</td>';
					echo '<td>';
					echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
						'height' => 20, 
						'width' => 20, 
						'alt' => __('[x]Delete'))),
						array(
							'plugin' => 'Newsletter', 
							'controller' => 'NewsletterRecipients', 
							'action' => 'delete', $recipient['NewsletterRecipient']['id']),
							array(
								'escape' => false, 
								'title' => __('Delete recipient')),
								__('Do you really want to delete this recipient?'));
					echo '</td>';
					echo '</tr>';
				}	
				
// 			$paging_params = $this->Paginator->params('NewsletterRecipient');
// 			if ($paging_params['count'] > 0){ 
// 				echo $this->Paginator->counter(array( 'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}',
// 												'model' => 'NewsletterRecipient'));
			
// 				if ($this->Paginator->hasPrev('NewsletterRecipient')){
// 					echo $this->Paginator->prev('<< ', array('model' => 'NewsletterRecipient'));
// 				}
// 				echo $this->Paginator->numbers(array('model' => 'NewsletterRecipient'));
// 				if ($this->Paginator->hasNext('NewsletterRecipient')){
// 					echo $this->Paginator->next(' >>', array('model' => 'NewsletterRecipient'));
// 				}
			
// 			}
		}	

		

	?>
	</tbody>
</table>
<!-- </div> -->

