<?php

$this->Html->script('jquery/jquery.quicksearch', false);
$this->Html->script('/newsletter/js/newsletter', false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

echo $this->element('admin_menu', array('contentID' => $contentID));

echo '<h2>'.__('Create new newsletter:').'</h2>';

echo $this->Form->create('createNewsletter', array(
			'url' => array(
				'plugin' => 'Newsletter',
	    		'controller' => 'NewsletterLetters',
	    		'action' => 'create', $contentID, 'new')));
echo $this->Form->submit(__('Create newsletter'));
echo $this->Form->end();

echo '<br><hr><br>';
echo '<h2>'.__('Newsletters:').'</h2>';
echo '<br>';

echo $this->Session->flash('NewsletterDeleted');

echo $this->Form->create('search');
echo $this->Form->input('NewsletterLetter.subject', array(
	'label' => __('Search Newsletter:'),
	'id' => 'search_newsletter'));
echo $this->Form->end();

echo '<table id="newsletters">';

echo '<thead>';
	echo '<tr>';
		echo '<th></th>';
		echo '<th>'.__('Subject').'</th>';
		echo '<th>'.__('Date').'</th>';
		echo '<th>'.__('Status').'</th>';
		echo '<th></th>';
		echo '<th></th>';
		echo '<th></th>';
	echo '</tr>';
echo '</thead>';
echo '<tbody>';

if (isset($newsletters)){
	echo $this->Form->create('selectNewsletters', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'deleteSelected', $contentID),
		'onsubmit'=>'return confirm(\''.__('Do you really want to delete the selected newsletters?').'\');'));
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
				if ($newsletter['NewsletterLetter']['draft'] == 1){
					echo __('draft');
				} else {
					echo __('sent');
				}
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
			};
			echo 	'</tr>';
	} //foreach	
	echo '</tbody>';
	echo '<tfoot>'; 
	echo '<tr>';
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/arrow.png', array(
							'height' => 20,
							'width' => 20));
	echo '</td>';
	echo '<td>';
	echo $this->Form->submit(_('Delete'), array(
								'height' => 20,
								'width' => 20,
								'alt' => __('[x]Delete')));
	echo $this->Form->end();
	echo '</td>';
	echo '</tr>';
	echo '</tfoot>';
	
	
};
echo '</table>';
?>

<?php 

// $paging_params = $this->Paginator->params('NewsletterLetter');
// if ($paging_params['count'] > 0){
// 	echo $this->Paginator->counter(array(
// 			'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}  ',
// 			'model' => 'NewsletterLetter'));
	
// 	if ($this->Paginator->hasPrev('NewsletterLetter')){
// 		echo $this->Paginator->prev(' << ', array(
// 				'model' => 'NewsletterLetter'));
// 	};
// 	echo $this->Paginator->numbers(array(
// 			'model' => 'NewsletterLetter'));
// 	if ($this->Paginator->hasNext('NewsletterLetter')){
// 		echo $this->Paginator->next(' >> ', array(
// 				'model' => 'NewsletterLetter'));
// 	};
// };

?>
