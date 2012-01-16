<?php 

$this->Html->script('jquery.quicksearch', false); 
$this->Html->script('/newsletter/js/newsletter', false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');

echo $this->element('admin_menu', array('contentID' => $contentID));

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
echo $this->Form->create('search');
echo $this->Form->input('NewsletterRecipient.email', array(
	'label' => 'Search Recipient:',
	'id' => 'search_recipient'));
echo $this->Form->end();
?>
<!-- <form>Search Recipient: <input type="text" id="search_recipient"/></form> -->
<table id='recipients'>
	<thead>
	<tr>
		<th>Email</th>
		<th>Username</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
		<?php
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
			}//foreach	
		}	
		?>
	</tbody>
</table>


