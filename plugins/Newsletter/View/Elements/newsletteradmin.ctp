// <?php
// 	$this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => true));
// 	$this->Html->script('/ckeditor/ckeditor', false);
// 	echo $this->Html->scriptBlock('function showDiv(idOn,idOff){
// 		if(document.getElementById(idOn).style.display=="none") {
// 			document.getElementById(idOff).style.display="none";
// 		    document.getElementById(idOn).style.display="block";
// 		} else {
// 			document.getElementById(idOn).style.display="none";
// 		    document.getElementById(idOff).style.display="block";
// 		};
// 	}');
// 	if ($mode == 'edit' or $mode == 'preview'){
// 		echo '<div id="list" style="display:none">';
// 	} else {
// 		echo '<div id="list" style="display:block">';
// 	}
// 	echo '<table>';
// 	echo	'<colgroup>';
// 	echo		'<col/>';
// 	echo		'<col/>';
// 	echo		'<col/>';
// 	echo	'</colgroup>';
// 	echo	'<tr>';
// 	echo		'<th>Subject</th>';
// 	echo		'<th>Date</th>';
// 	echo	'</tr>';
// 	echo $this->Form->create('createNewsletter', array(
// 			'url' => array(
// 				'plugin' => 'Newsletter',
// 	    		'controller' => 'Subscription',
// 	    		'action' => 'createNewsletter' , '')));
// 	echo $this->Form->submit('Create newsletter');
// 	echo $this->Form->end();
// 	if (isset($newsletters)){
// 		foreach($newsletters as $newsletter){
// 			echo '<tr>';
// 			echo 	'<td>';				
// 			echo 		$newsletter['NewsletterLetter']['subject'];
// 			echo 	'</td>';
// 			echo 	'<td>';
// 			echo		$newsletter['NewsletterLetter']['date'];
// 			echo	'</td>';
// 			echo 	'<td>';
// 			echo 		$this->Html->image('/app/webroot/img/arrow_right.png',
// 							array(
// 								'style' => 'float: left', 
// 								'width' => '20px', 
// 								'alt' => '[]Preview', 
// 								'url' => array(
// 									'plugin' => 'Newsletter', 
// 									'controller' => 'Subscription', 
// 									'action' => 'previewNewsletter', $newsletter['NewsletterLetter']['id'])));
// 			echo 	'</td>';
// 			if ($newsletter['NewsletterLetter']['draft'] == 1){
// 				echo 	'<td>';
// 				echo 		$this->Html->image('/app/webroot/img/edit.png', 
// 								array(
// 									'style' => 'float: left', 
// 									'width' => '20px', 
// 									'alt' => '[]Edit', 
// 									'url' => array(
// 										'plugin' => 'Newsletter', 
// 										'controller' => 'Subscription', 
// 										'action' => 'editNewsletter', $newsletter['NewsletterLetter']['id'])));
// 				echo 	'</td>';
// 				echo 	'<td>';				
// 				echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
// 					'height' => 20, 
// 					'width' => 20, 
// 					'alt' => __('[x]Delete'))),
// 					array(
// 						'plugin' => 'Newsletter', 
// 						'controller' => 'Subscription', 
// 						'action' => 'deleteNewsletter', $newsletter['NewsletterLetter']['id']),
// 						array(
// 							'escape' => false, 
// 							'title' => __('Delete newsletter')),
// 							__('Do you really want to delete this newsletter?'));
// 				echo 	'</td>';
// 				};
// 			echo 	'</tr>';
// 		} //foreach	
// 		$paging_params = $this->Paginator->params('NewsletterLetter');
// 		if ($paging_params['count'] > 0){ 
// 			echo $this->Paginator->counter(array( 
// 				'format' => 'Entrys {:start} to {:end} of {:count}, page {:page} of {:pages}  ',
// 				'model' => 'NewsletterLetter'));
// 			if ($this->Paginator->hasPrev('NewsletterLetter')){
// 				echo $this->Paginator->prev(' << ', array(
// 					'model' => 'NewsletterLetter'));
// 			};
// 			echo $this->Paginator->numbers(array(
// 				'model' => 'NewsletterLetter'));
// 			if ($this->Paginator->hasNext('NewsletterLetter')){
// 				echo $this->Paginator->next(' >> ', array(
// 					'model' => 'NewsletterLetter'));
// 			};
// 		};
// 	};
// 	echo '</table>';
// 	echo '</div>';
// 	if ($mode == 'edit'){
// 		echo '<div id="editor" style="display:block">';
// 		if (isset($newsletterToEdit)){
// 			echo $this->Form->create('editor', array(
// 				'url' => array(
// 					'plugin' => 'Newsletter',
// 		    		'controller' => 'Subscription',
// 		    		'action' => 'saveNewsletter' , $newsletterToEdit['id'])));
// 			echo $this->Form->input('NewsletterLetter.subject', array(
// 				'label' => 'Betreff:', 
// 				'value' => $newsletterToEdit['subject']));
// 			echo $this->Form->textarea('NewsletterLetter.content', array(
// 				'label' => '', 
// 				'value' => $newsletterToEdit['content'],
// 				'rows' => '30'));
// 			echo $this->Form->button('Save', array(
// 				'type' => 'submit', 
// 				'value' => 'save'));
// 			echo $this->Form->button('Back', array(
// 				'type' => 'button',
// 				'onClick' => 'location.href=\'/plugin/Newsletter/Subscription/newsletteradmin/\';'));
// 			echo $this->Form->end();
// 			echo $this->Fck->load('NewsletterLetter.content');
//  		};
//  		echo '</div>';
// 	} else {
// 		echo '<div id="editor" style="display:none">';
// 		echo '</div>';
// 	}
	
// 	if ($mode == 'preview'){
// 		echo '<div id="editor" style="display:block">';
// 		if (isset($newsletterToPreview)){
// 			echo $this->Form->create('editor', array(
// 				'url' => array(
// 					'plugin' => 'Newsletter',
// 		    		'controller' => 'Subscription',
// 		    		'action' => 'sendNewsletter' , $newsletterToPreview['id'])));
// 	// 		debug($newsletterToEdit);
// 			echo $this->Form->input('NewsletterLetter.subject', array(
// 				'label' => 'Betreff:', 
// 				'value' => $newsletterToPreview['subject']));
// 			echo $this->Form->textarea('NewsletterLetter.content', array(
// 				'label' => '', 
// 				'value' => $newsletterToPreview['content'],
// 				'rows' => '30'));
// 			echo $this->Form->button('Send', array(
// 				'type' => 'submit', 
// 				'value' => 'save'));
// 			echo $this->Form->button('Back', array(
// 				'type' => 'button',
// 				'onClick' => 'location.href=\'/plugin/Newsletter/Subscription/newsletteradmin/\';'));
// 			echo $this->Form->end();
			
// //			echo $this->Fck->load('NewsletterLetter.content');
			
// 			echo $this->Html->scriptBlock('
// 				CKEDITOR.replace( \'NewsletterLetterContent\',
// 									{
//        									readOnly : \'true\',
//     								});
// 				'
// 			, array('inline' => true));
				
//  		};
// 	} else {
// 		echo '<div id="editor" style="display:none">';
// 	}
// 	echo '</div>';
 ?>	

