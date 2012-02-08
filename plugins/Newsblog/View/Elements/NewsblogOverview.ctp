<?php
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Philipp Scholl
*
* @description View element to display the overview of news entries
*/

	App::uses('Sanitize', 'Utility');
	$data = Sanitize::clean($data, array('unicode' => true, 'encode' => false, 'remove_html' => true));;
	
	//load helpers
	$DateTimeHelper = $this->Helpers->load('Time');
	$this->Helpers->load('Slug');
	$this->Helpers->load('BBCode');
	$this->Helpers->load('SocialNetwork');
	
	//bind javascript and css
	$this->Html->script('jquery/jpaginate', false);
	$this->Html->script('/newsblog/js/showNews', false);
	$this->Html->css('/newsblog/css/showNews', null, array('inline' => false));
	$this->Html->css('/css/jpaginate', null, array('inline' => false));
	
	if($this->Session->check('Newsblog.itemsPerPage')){
		$itemsPerPage = $this->Session->read('Newsblog.itemsPerPage');
	} else{
		$itemsPerPage = 10;
	}
	$this->Js->set('itemsPerPage', $itemsPerPage);
	
	if($this->Session->check('Newsblog.shorttextLength')){
		$shorttextLength = $this->Session->read('Newsblog.shorttextLength');
	} else{
		$shorttextLength = 150;
	}
	
	//get permissions
	$allowedActions = $this->PermissionValidation->getPermissions($pluginId);
	$deleteAllowed = $allowedActions['Delete'];
	$editAllowed = $allowedActions['Edit'];
	
	$dateFormat = __('m-d-Y');
	$this->Js->set('dateFormatForPicker', $dateFormat);
	
	$hideConfigurationText = __d('newsblog', 'Hide Configuration');
	$this->Js->set('hideConfigText', $hideConfigurationText);
	$showConfigurationText = __d('newsblog', 'Show Configuration');
	$this->Js->set('showConfigText', $showConfigurationText);
?>
<?php 
	if($data['newsblogTitle'] != null || $data['newsblogTitle'] != ''){
		echo '<h1 class="newsblogtitle">';
		echo $data['newsblogTitle'];
		echo '</h1><div class="newsblogtitle_border color1"></div>';
	}?>

<div class='newsblogcontainer'>

<?php 
if( count($data['publishedNewsEntries']) > 0){
	foreach($data['publishedNewsEntries'] as $NewsEntry):
		$newsEntryId = $NewsEntry['NewsEntry']['id'];
		$newsblogEntryDivId = "newsblogEntry".$newsEntryId;
		$title = $NewsEntry['NewsEntry']['title'];
		$subtitle = $NewsEntry['NewsEntry']['subtitle'];
		$titleForUrl = $this->Slug->generateSlug($title);
		$text = $this->BBCode->removeBBCode($NewsEntry['NewsEntry']['text']);
		if(strlen($text) > $shorttextLength){
			$substrEnd = $shorttextLength - 3;
			$text = substr($text, 0, $substrEnd)."...";
		}
		
		$createdOnDate = $DateTimeHelper->format('m-d-Y', $NewsEntry['NewsEntry']['createdOn']);
		$createdOnTime = $DateTimeHelper->format('H:i', $NewsEntry['NewsEntry']['createdOn']);
		$createdBy = $NewsEntry['Author']['username'];
		
		$infoString = __d('newsblog', 'infostring');
		$infoString = str_replace(':-author-:', $createdBy, $infoString);
		$infoString = str_replace(':-date-:', $createdOnDate, $infoString);
		$infoString = str_replace(':-time-:', $createdOnTime, $infoString);
		
		$modifiedString = __d('newsblog', 'modifiedstring');
		if($NewsEntry['NewsEntry']['lastModifiedOn'] != null){
			$modifiedOnDate = $DateTimeHelper->format($dateFormat, $NewsEntry['NewsEntry']['lastModifiedOn']);
			$modifiedOnTime = $DateTimeHelper->format('H:i', $NewsEntry['NewsEntry']['lastModifiedOn']);
			$modifiedString = str_replace(':-date-:', $modifiedOnDate, $modifiedString);
			$modifiedString = str_replace(':-time-:', $modifiedOnTime, $modifiedString);
		}
	?>
	
	<div class="newsblog_entry" id="<?php echo $newsblogEntryDivId?>">
		<div class="newsblog_entry_container">
			<div class="newsblog_entry_title"><h2><?php echo $title?></h2></div>
			<?php if($subtitle != null & $subtitle != ''){?>
			<div class="newsblog_entry_subtitle"><h3><?php echo $subtitle?></h3></div>
			<?php }?>
			<div class="newsblog_entry_info">
				<?php 
					if($NewsEntry['NewsEntry']['lastModifiedOn'] != null){
						echo $infoString."&nbsp;&nbsp;(".$modifiedString.")";
					} else{
						echo $infoString;
					}
				?>
			</div>
			<div class="newsblog_entry_content"><?php echo $text?></div>
			<div class="newsblog_entry_footer">
				<?php 
				echo $this->Html->link(
					__d('newsblog', 'Full Article'),
					$url.'/shownews/'.$newsEntryId.'-'.$titleForUrl,
					array('class' => 'newsblog_entry_read_link', 'escape' => false)
				);
				?>
			</div>
		</div>
		<div class="newsblog_entry_social">
			<?php 
				$socialURL = $this->Html->url($url.'/shownews/'.$newsEntryId.'-'.$titleForUrl, true);
				
				$socialNetworks = $data['socialNetworks'];
				//Facebook
				if($socialNetworks['facebook']){
					echo $this->SocialNetwork->insertFacebookShare($socialURL);
				}
				
				//Google+
				if($socialNetworks['googleplus']){
					echo $this->SocialNetwork->insertGoogleShare($socialURL);
				}
				
				//Twitter
				if($socialNetworks['twitter']){
					echo $this->SocialNetwork->insertTwitterShare($socialURL);
				}
				
				//Xing
				if($socialNetworks['xing']){
					echo $this->SocialNetwork->insertXingShare($socialURL);
				}
				
				//LinkedIn
				if($socialNetworks['linkedin']){
					echo $this->SocialNetwork->insertLinkedShare($socialURL);
				}?>
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
					__d('newsblog', 'Would you really like to delete this entry?')
				);
			}
			?>
		</div>
		<hr class="newsentries_divider">
	</div>
<?php endforeach; ?>
<?php 
} else{
	//echo "<div>There are currently no published news entries in this newsblog.</div>";
}?>

</div>

<div class='newsblogreadconfig'>
<div class='newsblogreadconfig_button'>
<a style="cursor:pointer;"><?php echo $showConfigurationText;?></a>
	</div>
	<div class='newsblogreadconfig_items'>
	<?php
	echo $this->Form->create(null, array('url' => array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'general'), 'class' => 'newsblogreadconfig_form'));
	//get current 
	echo $this->Form->input(null, array(
		'options' => array(10 => 10, 15 => 15, 20 => 20, 25 => 25),
		'name' => 'itemsPerPage',
		'label' => __d('newsblog', 'Items per page:'),
		'default' => 10,
		'value' => $itemsPerPage,
		'class' => 'newsblogreadconfig_select',
		'div' => 'configform_input'
	));
	
	echo $this->Form->input(null, array(
		'options' => array(150 => 150, 200 => 200, 250 => 250, 300 => 300, 350 => 350),
		'name' => 'previewTextLength',
		'label' => __d('newsblog', 'Preview text length:'),
		'default' => 150,
		'value' => $shorttextLength,
		'class' => 'newsblogreadconfig_select',
		'div' => 'configform_input'
	));
	
	//create submit button
	echo $this->Form->end(__d('newsblog', 'Save Configuration'));?>
	</div>
</div>

<?php
if($this->PermissionValidation->getUserRole() < 6 & ($allowedActions['Write'] || $allowedActions['Publish'])){
	echo '<div class="plugin_administration">';
		echo $this->Html->link($this->Html->image('tools_small.png'),array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'admin', $data['contentId']), array('escape' => false));
	echo '</div>';
}
?>