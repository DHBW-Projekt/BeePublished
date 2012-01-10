<?php 
	$this->Html->script('/newsblog/js/admin', false);
	$this->Html->css('/newsblog/css/admin', null, array('inline' => false));
	$this->Html->script('/ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('/ckeditor/adapters/jquery', array('inline' => false));
	
	$DateTimeHelper = $this->Helpers->load('Time');
	
	$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write');
	$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
?>

<div id="admin_newsblog" class="admin_newsblog_container">
	<ul>
		<?php 
			if($writeAllowed){
				echo '<li><a href="#admin_newsblog-write">Write News</a></li>';
			}
			if($publishAllowed){
				echo '<li><a href="#admin_newsblog-publish">Publish News</a></li>';
			}
		?>
		
		<li><a href="#admin_newsblog-config">General</a></li>
	</ul>
	
	<?php 
		if($writeAllowed){
			echo '<div id="admin_newsblog-write">';
			echo '<div class="writeNewsContainer">';
			
			//create form
			echo $this->Form->create('NewsEntry', array('url' => array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'saveNewsData')));
			//create title input
			echo $this->Form->input('NewsEntry.title', array(
				'div' => 'writeNewsTitle',
				'label' => false,
				'name' => 'title'
			));
			//create entrytext textarea
			echo $this->Form->textarea('NewsEntry.text', array(
				'div' => 'writeNewsBody',
				'label' => false,
				'id' => 'writeNewsTextEditor',
				'name' => 'text'
			));
			//create validFrom input
			echo $this->Form->text(null, array(
				'div' => 'writeValidConfiguration',
				'id' => 'nbValidFromDatepicker',
				'name' => 'validFrom',
				'class' => 'datepicker',
				'label' => 'Valid from:'
			));
			//create validTo input
			echo $this->Form->text(null, array(
				'div' => 'writeValidConfiguration',
				'id' => 'nbValidToDatepicker',
				'name' => 'validTo',
				'class' => 'datepicker',
				'label' => 'Valid to:'
			));
			//hidden fields
			//contentid
			echo $this->Form->hidden(null,array(
				'name' => 'contentId',
				'value' => $contentId
			));
			//action set to editNews
			echo $this->Form->hidden(null,array(
				'name' => 'action',
				'value' => 'createNews'
			));
			
			//create submit button
			echo $this->Form->submit("Create News", array(
				'div' => 'writeNewsButtons',
				'class' => 'button'
			));
		echo '</div>';
		echo '</div>';	
			
					/*echo '<div class="writeNewsTitle">';
						echo '<input type="text" id="nbTitleTextfield" class="nbTitleTextfield">';
					echo '</div>';
					echo '<div class="writeNewsBody">';
						echo '<textarea id="writeNewsTextEditor" name="editNewsTextEditor"></textarea>';
					echo '</div>';
					echo '<div class="writeValidConfiguration">';
						echo 'valid from <input type="text" id="nbValidFromDatepicker" class="datepicker"> to <input type="text" id="nbValidToDatepicker" class="datepicker">';
					echo '</div>';
					echo '<div class="writeNewsButtons">';
						echo '<div id="CreateButton" class="button">Create News</div>';
					echo '</div>';*/
		}
		if($publishAllowed){
			echo '<div id="admin_newsblog-publish">';
			if(count($entriesToPublish) > 0){
				foreach($entriesToPublish as $entryToPublish):
					$id = $entryToPublish['NewsEntry']['id'];
					$username = $entryToPublish['User']['username'];
					$title = $entryToPublish['NewsEntry']['title'];
					$text = $entryToPublish['NewsEntry']['text'];
					$createdOn = $entryToPublish['NewsEntry']['createdOn'];
					$createdOnDate = $DateTimeHelper->format('m-d-Y', $entryToPublish['NewsEntry']['createdOn']);
					$createdOnTime = $DateTimeHelper->format('H:i', $entryToPublish['NewsEntry']['createdOn']);
					
					echo '<div class="unpublished_newsentry" id="'.$id.'">';
						echo '<div class="newsentry_publish_container">';
							echo '<div class="newsentry_publish_title">'.$title.'</div>';
							echo '<div class="newsentry_publish_info">by '.$username.' on '.$createdOnDate.' at '.$createdOnTime.'</div>';
							echo '<div class="newsentry_publish_content">'.$text.'</div>';
						echo '</div>';
						echo '<div class="newsentry_publish_buttons">';
							echo $this->Html->link(
								$this->Html->image('/Newsblog/img/Symbol_Check.png', array('class' => 'newsentry_publish_icon', 'alt' => 'Publish')),
								array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'publishNews', $id),
								array('class' => 'newsentry_publish_link', 'escape' => false)
							);
						echo '</div>';
					echo '<hr></div>';
				endforeach;
			} else{
				echo 'No entries to publish!';
			}
			echo '</div>';
		}
	?>
	
	
	
	<div id="admin_newsblog-config">
		
	</div>
</div>