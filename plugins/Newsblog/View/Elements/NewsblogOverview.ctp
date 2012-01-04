<?php
	$DateTimeHelper = $this->Helpers->load('Time');
	
	$this->Html->script('/newsblog/js/showNews', false);
	$this->Html->css('/newsblog/css/showNews', null, array('inline' => false));
	
	$itemsPerPage = null;
	if($this->Session->check('Newsblog.itemsPerPage')){
		$itemsPerPage = $this->Session->read('Newsblog.itemsPerPage');
	} else{
		$itemsPerPage = 5;
	}
	$shorttextLength = null;
	if($this->Session->check('Newsblog.shorttextLength')){
		$shorttextLength = $this->Session->read('Newsblog.shorttextLength');
	} else{
		$shorttextLength = 250;
	}
	
	$deleteAllowed = $this->PermissionValidation->actionAllowed(22, 'Delete');
	$editAllowed = $this->PermissionValidation->actionAllowed(22, 'Edit');
	$newsblogTitle = $data['newsblogTitle']['NewsblogTitle']['title'];
?>

<div id='newsblogcontainer_<?php echo $newsblogTitle?>'>

<?php foreach($data['publishedNewsEntries'] as $NewsEntry):
		$newsEntryId = $NewsEntry['NewsEntry']['id'];
		$newsblogEntryDivId = "newsblogEntry".$newsEntryId;
		$title = $NewsEntry['NewsEntry']['title'];
		$titleForUrl = iconv("utf-8", "ASCII//TRANSLIT", $title);
		$text = $NewsEntry['NewsEntry']['text'];
		if(strlen($text) > $shorttextLength){
			$substrEnd = $shorttextLength - 3;
			$text = substr($text, 0, $substrEnd)."...";
		}
		$createdOnDate = $DateTimeHelper->format('m-d-Y', $NewsEntry['NewsEntry']['createdOn']);
		$createdOnTime = $DateTimeHelper->format('H:i', $NewsEntry['NewsEntry']['createdOn']);
		$createdBy = $NewsEntry['User']['username'];
	?>
	
	<div class="newsblog_entry" id="<?php echo $newsblogEntryDivId?>">
		<div class="newsblog_entry_container">
			<div class="newsblog_entry_title"><?php echo $title?></div>
			<div class="newsblog_entry_info">by <?php echo $createdBy?> on <?php echo $createdOnDate?> at <?php echo $createdOnTime?></div>
			<div class="newsblog_entry_content"><?php echo $text?></div>
			<div class="newsblog_entry_footer">
				<?php 
				echo $this->Html->link(
					'> Weiterlesen',
					$url.'/newsblog/'.$newsEntryId.'-'.$titleForUrl,
					array('class' => 'newsblog_entry_read_link', 'escape' => false)
				);
				?>
			</div>
		</div>
		<div class="newsblog_entry_buttons">
			<?php 
			if($editAllowed){
				echo $this->Html->link(
					$this->Html->image('/Newsblog/img/Edit.png', array('class' => 'newsentry_edit_button_icon', 'alt' => 'Edit')),
					array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'editNews', $newsEntryId),
					array('escape' => false, 'class' => 'iframe')
				);
			}
			if($deleteAllowed){
				echo $this->Html->link(
					$this->Html->image('/Newsblog/img/Delete.png', array('class' => 'newsentry_delete_button_icon', 'alt' => 'Delete')),
					array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'deleteNews', $newsEntryId),
					array('escape' => false),
					"Do you really would like to delete this entry?"
				);
			}
			?>
		</div>
		<hr>
	</div>
<?php endforeach;?>

</div>