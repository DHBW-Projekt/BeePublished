<?php
	$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => true));
?>
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
		$this->Html->script('/ckeditor/ckeditor', false);
		if (isset($newsletters)){
				foreach($newsletters as $newsletter){
					echo '<tr>';
					echo '<td>';
// 					$tab_id = 				
					echo $this->Html->link($newsletter['NewsletterLetter']['subject'], array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'newsletteradmin', $newsletter['NewsletterLetter']['id']));
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
			$paging_params = $this->Paginator->params('NewsletterLetter');
			if ($paging_params['count'] > 0){ 
				echo $this->Paginator->counter(array( 'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}  ',
												'model' => 'NewsletterLetter'));
			
				if ($this->Paginator->hasPrev('NewsletterLetter')){
					echo $this->Paginator->prev(' << ', array('model' => 'NewsletterLetter'));
				}
				echo $this->Paginator->numbers(array('model' => 'NewsletterLetter'));
				if ($this->Paginator->hasNext('NewsletterLetter')){
					echo $this->Paginator->next(' >> ', array('model' => 'NewsletterLetter'));
				}
			}
		}	

	

	?>
</table>
</div>
<div id='editor'>
 <?php 
 	echo '<br><br><br><br>';
 	if (isset($newsletterToEdit)){
		$content = $newsletterToEdit['NewsletterLetter']['content'];
		echo $this->Form->create('editor');
		echo $this->Form->input('NewsletterLetter.content', array('label' => ''));
		echo $this->Fck->load('NewsletterLetter.content');
// 		echo $this->Fck->load('edit');
 	};
 	

?>
</div>

