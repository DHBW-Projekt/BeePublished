<?php
	$DateTimeHelper = $this->Helpers->load('Time');
	$this->Helpers->load('Slug');
	$this->Helpers->load('BBCode');
	
	$this->Html->script('/newsblog/js/showNews', false);
	$this->Html->css('/newsblog/css/showNews', null, array('inline' => false));
	
	if($this->Session->check('Newsblog.itemsPerPage')){
		$itemsPerPage = $this->Session->read('Newsblog.itemsPerPage');
	} else{
		$itemsPerPage = 10;
	}
	if($this->Session->check('Newsblog.shorttextLength')){
		$shorttextLength = $this->Session->read('Newsblog.shorttextLength');
	} else{
		$shorttextLength = 150;
	}
	
	$allowedActions = $this->PermissionValidation->getPermissions($pluginId);
	$deleteAllowed = $allowedActions['Delete'];
	$editAllowed = $allowedActions['Edit'];
?>
<?php 
	if(!empty($data['newsblogTitle']['NewsblogTitle']) || $data['newsblogTitle']['NewsblogTitle'] != null || $data['newsblogTitle']['NewsblogTitle']['title'] != ''){
		echo '<div class="newsblogtitle">';
			echo $data['newsblogTitle']['NewsblogTitle']['title'];
			echo '<hr><hr>';
		echo '</div>';
	}

?>


<div class='newsblogcontainer'>

<?php 
if( count($data['publishedNewsEntries']) > 0){
	foreach($data['publishedNewsEntries'] as $NewsEntry):
		$newsEntryId = $NewsEntry['NewsEntry']['id'];
		$newsblogEntryDivId = "newsblogEntry".$newsEntryId;
		$title = $NewsEntry['NewsEntry']['title'];
		$subtitle = $NewsEntry['NewsEntry']['subtitle'];
		$titleForUrl = $this->Slug->generateSlug($title);
		$text = $this->BBCode->transformBBCode($NewsEntry['NewsEntry']['text']);
		if(strlen($text) > $shorttextLength){
			$substrEnd = $shorttextLength - 3;
			$text = substr($text, 0, $substrEnd)."...";
		}
		$createdOnDate = $DateTimeHelper->format('m-d-Y', $NewsEntry['NewsEntry']['createdOn']);
		$createdOnTime = $DateTimeHelper->format('H:i', $NewsEntry['NewsEntry']['createdOn']);
		$createdBy = $NewsEntry['Author']['username'];
		$modifiedOnDate = null;
		$modifiedOnTime = null;
		if($NewsEntry['NewsEntry']['lastModifiedOn'] != null){
			$modifiedOnDate = $DateTimeHelper->format('m-d-Y', $NewsEntry['NewsEntry']['lastModifiedOn']);
			$modifiedOnTime = $DateTimeHelper->format('H:i', $NewsEntry['NewsEntry']['lastModifiedOn']);
		}
	?>
	
	<div class="newsblog_entry" id="<?php echo $newsblogEntryDivId?>">
		<div class="newsblog_entry_container">
			<div class="newsblog_entry_title"><?php echo $title?></div>
			<?php if($subtitle != null & $subtitle != ''){?>
			<div class="newsblog_entry_subtitle"><?php echo $subtitle?></div>
			<?php }?>
			<div class="newsblog_entry_info">
				by <?php echo $createdBy?> on <?php echo $createdOnDate?> at <?php echo $createdOnTime;?>
				<?php 
					if(isset($modifiedOnDate) & isset($modifiedOnTime)){
						echo "&nbsp;&nbsp;(modified on ".$modifiedOnDate." at ".$modifiedOnTime.")";
					}
				?>
			</div>
			<div class="newsblog_entry_content"><?php echo $text?></div>
			<div class="newsblog_entry_footer">
				<?php 
				echo $this->Html->link(
					'> Weiterlesen',
					$url.'/shownews/'.$newsEntryId.'-'.$titleForUrl,
					array('class' => 'newsblog_entry_read_link', 'escape' => false)
				);
				?>
			</div>
		</div>
		<div class="newsblog_entry_buttons">
			<?php 
			if($editAllowed){
				echo $this->Html->link(
					$this->Html->image('edit.png', array('class' => 'newsentry_edit_button_icon', 'alt' => 'Edit')),
					array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'edit', $newsEntryId),
					array('escape' => false, 'class' => 'overlay')
				);
			}
			if($deleteAllowed){
				echo $this->Html->link(
					$this->Html->image('delete.png', array('class' => 'newsentry_delete_button_icon', 'alt' => 'Delete')),
					array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'delete', $newsEntryId),
					array('escape' => false),
					"Would you really like to delete this entry?"
				);
			}
			?>
		</div>
		<hr class="newsentries_divider">
	</div>
<?php endforeach;
} else{
	//echo "<div>There are currently no published news entries in this newsblog.</div>";
}?>

</div>
<?php
if($this->PermissionValidation->getUserRole() < 6 && ($allowedActions['Write'] || $allowedActions['Publish'])){
	echo '<div class="plugin_administration">';
		echo $this->Html->link($this->Html->image('tools_small.png'),array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'admin', $data['contentId']), array('escape' => false));
	echo '</div>';
}
?>