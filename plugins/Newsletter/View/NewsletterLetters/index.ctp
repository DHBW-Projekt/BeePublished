<?php
echo $this->element('admin_menu');
echo 'Newsletters';



echo '<table>';
echo	'<colgroup>';
echo		'<col/>';
echo		'<col/>';
echo		'<col/>';
echo	'</colgroup>';
echo	'<tr>';
echo		'<th>Subject</th>';
echo		'<th>Date</th>';
echo	'</tr>';
echo $this->Form->create('createNewsletter', array(
			'url' => array(
				'plugin' => 'Newsletter',
	    		'controller' => 'NewsletterLetters',
	    		'action' => 'create' , '')));
echo $this->Form->submit('Create newsletter');
echo $this->Form->end();
if (isset($newsletters)){
	foreach($newsletters as $newsletter){
		echo '<tr>';
		echo 	'<td>';
		echo 		$newsletter['NewsletterLetter']['subject'];
		echo 	'</td>';
		echo 	'<td>';
		echo		$newsletter['NewsletterLetter']['date'];
		echo	'</td>';
		echo 	'<td>';
		echo 		$this->Html->image('/app/webroot/img/arrow_right.png',
		array(
								'style' => 'float: left', 
								'width' => '20px', 
								'alt' => '[]Preview', 
								'url' => array(
									'plugin' => 'Newsletter', 
									'controller' => 'NewsletterLetters', 
									'action' => 'preview', $newsletter['NewsletterLetter']['id'])));
		echo 	'</td>';
		if ($newsletter['NewsletterLetter']['draft'] == 1){
			echo 	'<td>';
			echo 		$this->Html->image('/app/webroot/img/edit.png',
			array(
									'style' => 'float: left', 
									'width' => '20px', 
									'alt' => '[]Edit', 
			// 									'onClick' => 'showDiv(\'editor\', \'list\')',
									'url' => array(
										'plugin' => 'Newsletter', 
										'controller' => 'NewsletterLetters', 
										'action' => 'edit', $newsletter['NewsletterLetter']['id'])));
			echo 	'</td>';
			echo 	'<td>';
			echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
					'height' => 20, 
					'width' => 20, 
					'alt' => __('[x]Delete'))),
			array(
						'plugin' => 'Newsletter', 
						'controller' => 'NewsletterLetters', 
						'action' => 'delete', $newsletter['NewsletterLetter']['id']),
			array(
							'escape' => false, 
							'title' => __('Delete newsletter')),
			__('Do you really want to delete this newsletter?'));
			echo 	'</td>';
		};
		echo 	'</tr>';
	} //foreach
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
echo '</table>';