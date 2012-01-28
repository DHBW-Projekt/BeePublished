<?php
$this->Html->script('jquery/jquery.dataTables.min', false);
$this->Html->script('/newsletter/js/newsletter', false);
$lang = Configure::read("Config.language");
$path = $this->Html->url("/language/".$lang.".txt", true);
$this->Js->set('language_path', $path);

echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));
echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));

echo '<h2>'.__d('newsletter','Create new newsletter:').'</h2>';

echo $this->Form->create('createNewsletter', array(
			'url' => array(
				'plugin' => 'Newsletter',
	    		'controller' => 'NewsletterLetters',
	    		'action' => 'create', $contentID, $pluginId, 'new')));
echo $this->Form->submit(__d('newsletter','Create newsletter'));
echo $this->Form->end();

echo '<br><hr><br>';
echo '<h2>'.__d('newsletter','Newsletters:').'</h2>';
echo '<br>';

echo $this->Session->flash('NewsletterDeleted');
echo $this->Form->create('selectNewsletters', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'deleteSelected', $contentID, $pluginId),
			'onsubmit'=>'return confirm(\''.__d('newsletter','Do you really want to delete the selected newsletters?').'\');'));
echo '<table id="newsletters">';
echo '<thead>';
	echo '<tr>';
		echo '<th></th>';
		echo '<th>'.__d('newsletter','Subject').'</th>';
		echo '<th>'.__d('newsletter','Date').'</th>';
		echo '<th>'.__d('newsletter','Status').'</th>';
		echo '<th></th>';
	echo '</tr>';
echo '</thead>';
echo '<tbody>';

if (isset($newsletters)){
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
					echo __d('newsletter','draft');
				} else {
					echo __d('newsletter','sent');
				}
			echo '</td>';
			echo '<td style="width:60px">';
				echo $this->Html->image('/app/webroot/img/preview.png',array(
					'style' => 'float: left', 
					'width' => '20px', 
					'alt' => '[]Preview', 
					'url' => array(
						'plugin' => 'Newsletter', 
						'controller' => 'NewsletterLetters', 
						'action' => 'preview', $contentID, $pluginId, $newsletter['NewsletterLetter']['id'])));
			
			if ($newsletter['NewsletterLetter']['draft'] == 1){
				
					echo $this->Html->image('/app/webroot/img/edit.png', array(
						'style' => 'float: left', 
						'width' => '20px', 
						'alt' => '[]Edit', 
						'url' => array(
							'plugin' => 'Newsletter', 
							'controller' => 'NewsletterLetters', 
							'action' => 'edit', $contentID, $pluginId, $newsletter['NewsletterLetter']['id'])));
				
				
					echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
						'height' => 20, 
						'width' => 20, 
						'alt' => __d('newsletter','[x]Delete'))),
						array(
							'plugin' => 'Newsletter', 
							'controller' => 'NewsletterLetters', 
							'action' => 'delete', $contentID, $pluginId, $newsletter['NewsletterLetter']['id']),
							array(
								'escape' => false, 
								'title' => __d('newsletter','Delete newsletter')),
								__d('newsletter','Do you really want to delete this newsletter?'));
				echo 	'</td>';
			} else {
				
				echo $this->Html->image('/app/webroot/img/edit_disabled.png', array(
					'style' => 'float: left', 
					'width' => '20px', 
					'alt' => '[]Edit', 
					'url' => array(
						'plugin' => 'Newsletter', 
						'controller' => 'NewsletterLetters', 
						'action' => 'edit', $contentID, $pluginId, $newsletter['NewsletterLetter']['id'])));
				
				
				echo $this->Html->image('/app/webroot/img/delete_disabled.png', array(
					'height' => 20, 
					'width' => 20, 
					'alt' => __d('newsletter','[x]Delete')));
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
			echo '<td>';;
				echo $this->Form->submit(__d('newsletter','Delete'), array(
								'height' => 20,
								'width' => 20,
								'alt' => __d('newsletter','[x]Delete')));
				
			echo '</td>';
		echo '</tr>';
	echo '</tfoot>';
	
	
};
echo '</table>';
echo $this->Form->end();
?>
