<?php 

$this->Html->script('jquery/jquery.quicksearch', false); 
$this->Html->script('/newsletter/js/newsletter', false);
$this->Html->script('jquery/jquery.dataTables.min', false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
$lang = Configure::read("Config.language");
$path = $this->Html->url("/language/".$lang.".txt", true);
$this->Js->set('language_path', $path);

$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');

echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));

echo '<h2>'.__d('newsletter','Add recipient:').'</h2>';
echo $this->Session->flash('NewsletterRecipient');
echo $this->Form->create('add',array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterRecipients',
		'action' => 'add', $pluginId)));
echo $this->Form->input('NewsletterRecipient.email', array(
	'label' => __d('newsletter','E-Mail:')));
if (isset($validationErrors['email'][0])){
	echo $this->Html->div('validation_error',$validationErrors['email'][0]);
};
echo $this->Form->end(__d('newsletter','Add'));
echo '<br><hr><br>';
echo '<h2>'.__d('newsletter','Subscriptions:').'</h2>';
echo $this->Session->flash('RecipientDeleted');
echo $this->Form->create('selectRecipients', array(
				'url' => array(
					'plugin' => 'Newsletter',
					'controller' => 'NewsletterRecipients',
					'action' => 'deleteSelected', $contentID, $pluginId),
				'onsubmit'=>'return confirm(\''.__d('newsletter','Do you really want to delete the selected recipients?').'\');'));
echo '<table id="recipients">';
	echo '<thead>';
		echo '<tr>';
			echo '<th></th>';
			echo '<th>'.__d('newsletter','Email').'</th>';
			echo '<th>'.__d('newsletter','Username').'</th>';
			echo '<th></th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
		if (isset($recipients)){

			foreach($recipients as $recipient){
				echo '<tr>';
					echo '<td>';
					echo $this->Form->checkbox($recipient['NewsletterRecipient']['id']);
					echo '</td>'; 
					echo '<td>'.$recipient['NewsletterRecipient']['email'].'</td>';
					echo '<td>'.$recipient['User']['username'].'</td>';
					echo '<td>';
						echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
							'height' => 20, 
							'width' => 20, 
							'alt' => __d('newsletter','[x]Delete'))),
							array(
								'plugin' => 'Newsletter', 
								'controller' => 'NewsletterRecipients', 
								'action' => 'delete', $pluginId, $recipient['NewsletterRecipient']['id']),
								array(
									'escape' => false, 
									'title' => __d('newsletter','Delete recipient')),
									__d('newsletter','Do you really want to delete this recipient?'));
					echo '</td>';
				echo '</tr>';
			}//foreach
			echo '</tbody>';
			echo '<tfoot>';	
				echo '<tr>';
					echo '<td>';
					echo $this->Html->image('/app/webroot/img/arrow.png', array(
						'height' => 20,
						'width' => 20));
					echo '</td>';
					echo '<td>';
						echo $this->Form->submit(__d('newsletter','Delete'), array(
							'height' => 20,
							'width' => 20,
							'alt' => __d('newsletter','[x]Delete')));
						
					echo '</td>';
				echo '</tr>';
			echo '</tfoot>';	
		}
	echo '</table>';	
	echo $this->Form->end();
?>
	


