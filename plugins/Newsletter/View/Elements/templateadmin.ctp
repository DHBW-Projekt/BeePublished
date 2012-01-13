<?php
	$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => true));
	$this->Html->script('/ckeditor/ckeditor', false);
	echo $this->Html->scriptBlock('function showDiv(idOn,idOff){
		if(document.getElementById(idOn).style.display=="none") {
			document.getElementById(idOff).style.display="none";
		    document.getElementById(idOn).style.display="block";
		} else {
			document.getElementById(idOn).style.display="none";
		    document.getElementById(idOff).style.display="block";
		};
	}');
	if(!isset($mode)){
		$mode = '';
	};
	echo '<div id="list" style="display:block">';
	echo '<table>';
	echo	'<colgroup>';
	echo		'<col/>';
	echo		'<col/>';
	echo		'<col/>';
	echo	'</colgroup>';
	echo	'<tr>';
	echo		'<th>Template</th>';
	echo	'</tr>';
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
									'controller' => 'Subscription', 
									'action' => 'newsletterPreview', $newsletter['NewsletterLetter']['id'])));
			echo 	'</td>';
			echo 	'<td>';
			echo 		$this->Html->image('/app/webroot/img/edit.png', 
							array(
								'style' => 'float: left', 
								'width' => '20px', 
								'alt' => '[]Edit', 
								'onClick' => 'showDiv(\'editor\', \'list\')',
								'url' => array(
									'plugin' => 'Newsletter', 
									'controller' => 'Subscription', 
									'action' => 'newsletteradmin', $newsletter['NewsletterLetter']['id'])));
			echo 	'</td>';
			echo 	'<td>';
			echo 		$this->Html->image('/app/webroot/img/delete.png',
							array(
								'style' => 'float: left', 
								'width' => '20px', 
								'alt' => '[x]Delete', 
								'url' => array(
									'plugin' => 'Newsletter', 
									'controller' => 'Subscription', 
									'action' => 'deleteNewsletter', $newsletter['NewsletterLetter']['id'])));
			echo 	'</td>';
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
	echo '</div>';
	echo '<div id="editor" style="display:none">';
  	echo '<br><br><br><br>';
 	if (isset($newsletterToEdit)){
		$content = $newsletterToEdit['NewsletterLetter']['content'];
		echo $this->Form->create('editor', array(
			'url' => array(
				'plugin' => 'Newsletter',
	    		'controller' => 'Subscription',
	    		'action' => 'saveNewsletter' , $newsletterToEdit['NewsletterLetter']['id'])));
		$templates = array('M' => 'Male', 'F' => 'Female');
		echo $this->Form->select('template', $templates);
		echo $this->Form->input('NewsletterLetter.subject', array(
			'label' => 'Betreff:', 
			'value' => $newsletterToEdit['NewsletterLetter']['subject']));
		echo $this->Form->input('NewsletterLetter.content', array(
			'label' => '', 
			'value' => $newsletterToEdit['NewsletterLetter']['content']));
		echo $this->Form->button('Save', array(
			'type' => 'submit', 
			'value' => 'save'));
		echo $this->Form->end();
 	};
 	echo '</div>';
 ?>	

