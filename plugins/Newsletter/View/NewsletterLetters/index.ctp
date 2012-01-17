<?php
echo $this->element('admin_menu', array('contentID' => $contentID));
echo $this->Session->flash('NewsletterDeleted');
?>

<table>
	<tr>
		<th></th>
		<th>Subject</th>
		<th>Date</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	
<?php
echo $this->Form->create('createNewsletter', array(
			'url' => array(
				'plugin' => 'Newsletter',
	    		'controller' => 'NewsletterLetters',
	    		'action' => 'create', $contentID)));
echo $this->Form->submit('Create newsletter');

echo $this->Form->end();
echo '<br><br>';
if (isset($newsletters)){
	echo $this->Form->create('selectNewsletters', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'deleteSelected', $contentID),
		'onsubmit'=>'return confirm("Do you really want to delete the selected newsletters?");'));
	foreach($newsletters as $newsletter){
		echo '<tr>';
			echo '<td>';
			if ($newsletter['NewsletterLetter']['draft'] == 1){
				echo $this->Form->checkbox($newsletter['NewsletterLetter']['id']);
			} else {
				echo $this->Form->checkbox($newsletter['NewsletterLetter']['id'], array(
					'disabled' => true));
			};
			echo '</td>';
			echo '<td>';
				echo $newsletter['NewsletterLetter']['subject'];
			echo '</td>';
			echo '<td>';
				echo $newsletter['NewsletterLetter']['date'];
			echo '</td>';
			echo '<td>';
				echo $this->Html->image('/app/webroot/img/preview.png',array(
					'style' => 'float: left', 
					'width' => '20px', 
					'alt' => '[]Preview', 
					'url' => array(
						'plugin' => 'Newsletter', 
						'controller' => 'NewsletterLetters', 
						'action' => 'preview', $contentID, $newsletter['NewsletterLetter']['id'])));
			echo '</td>';
			if ($newsletter['NewsletterLetter']['draft'] == 1){
				echo '<td>';
					echo $this->Html->image('/app/webroot/img/edit.png', array(
						'style' => 'float: left', 
						'width' => '20px', 
						'alt' => '[]Edit', 
						'url' => array(
							'plugin' => 'Newsletter', 
							'controller' => 'NewsletterLetters', 
							'action' => 'edit', $contentID, $newsletter['NewsletterLetter']['id'])));
				echo '</td>';
				echo '<td>';
					echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
						'height' => 20, 
						'width' => 20, 
						'alt' => __('[x]Delete'))),
						array(
							'plugin' => 'Newsletter', 
							'controller' => 'NewsletterLetters', 
							'action' => 'delete', $contentID, $newsletter['NewsletterLetter']['id']),
							array(
								'escape' => false, 
								'title' => __('Delete newsletter')),
								__('Do you really want to delete this newsletter?'));
				echo 	'</td>';
			} else {
				echo '<div id="disabled" disabled>';
				echo '<td>';
				echo $this->Html->image('/app/webroot/img/edit_disabled.png', array(
					'style' => 'float: left', 
					'width' => '20px', 
					'alt' => '[]Edit', 
					'url' => array(
						'plugin' => 'Newsletter', 
						'controller' => 'NewsletterLetters', 
						'action' => 'edit', $contentID, $newsletter['NewsletterLetter']['id'])));
				echo '</td>';
				echo '<td>';
				echo $this->Html->image('/app/webroot/img/delete_disabled.png', array(
					'height' => 20, 
					'width' => 20, 
					'alt' => __('[x]Delete')));
				echo '</td>';
				echo '</div>';
			};
			echo 	'</tr>';
	} //foreach
	echo '<tfoot>';
	echo '<tr>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/selected_arrow.png', array(
							'height' => 20,
							'width' => 20));
	echo '</td>';
	echo '<td>';
	echo $this->Form->submit('Delete selection', array(
								'height' => 20,
								'width' => 20,
								'alt' => __('[x]Delete')));
	echo $this->Form->end();
	echo '</td>';
	echo '</tr>';
	echo '</tfoot>';
	
	$paging_params = $this->Paginator->params('NewsletterLetter');
	if ($paging_params['count'] > 0){
		echo $this->Paginator->counter(array(
			'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}  ',
			'model' => 'NewsletterLetter'));
		if ($this->Paginator->hasPrev('NewsletterLetter')){
			echo $this->Paginator->prev(' << ', array(
				'model' => 'NewsletterLetter'));
		};
		echo $this->Paginator->numbers(array(
			'model' => 'NewsletterLetter'));
		if ($this->Paginator->hasNext('NewsletterLetter')){
			echo $this->Paginator->next(' >> ', array(
				'model' => 'NewsletterLetter'));
		};
	};
};
?>
</table>

